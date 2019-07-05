<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Form\EditCampaignType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Payment;
use App\Entity\Participant;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @Route("/campaign")
 */
class CampaignController extends AbstractController
{


    /**
     * @Route("/new", name="campaign_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $campaign = new Campaign();
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $campaign->setId();
            $entityManager->persist($campaign);
            $entityManager->flush();

            return $this->redirectToRoute('campaign_show', ['id' => $campaign->getId()]);
        }

        return $this->render('campaign/new.html.twig', [
            'campaign' => $campaign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="campaign_show", methods={"GET"})
     */
    public function show(Campaign $campaign): Response
    {
        $allParticipantsByCampaignId = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->findBy([
                'campaign' => $campaign->getId(),
            ]);
        $totalParticipant = count($allParticipantsByCampaignId);

        $allPayments  = $this->getDoctrine()
            ->getRepository(Payment::class)
            ->findBy([
                'participant' => $allParticipantsByCampaignId,
            ]);
    
        $totalAmount = 0;

        foreach ($allPayments as $payment) {
            $totalAmount += $payment->getAmount();
        }

        $campaignAdvancement = ($totalAmount / $campaign->getGoal()) * 100;

        $form = $this->createForm(EditCampaignType::class);
        
        return $this->render('campaign/show.html.twig', [
            'campaign' => $campaign,
            'totalParticipant' => $totalParticipant,
            'totalAmount'=> $totalAmount,
            'campaignAdvancement' => $campaignAdvancement,
            'payments'=>$allPayments,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="campaign_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Campaign $campaign, ObjectManager $manager): Response
    {
        $campaign->setContent($request->request->get('edit_campaign')['content']);

        $manager->persist($campaign);
        $manager->flush();
        
        return $this->redirectToRoute('campaign_show', ['id' => $campaign->getId()]);
    }
}
