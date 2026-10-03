<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\VideoRepository;
use Symfony\Component\String\Slugger\SluggerInterface;

class VideoController extends AbstractController
{
    #[Route('/admin/video/new', name: 'video_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger,
   VideoRepository $videoRepository
): Response {
    $videos = $videoRepository->findBy(
        [],
        ['id' => 'DESC']
    );
        $video = new Video();

        $form = $this->createForm(VideoType::class, $video);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $videoFile = $form->get('videoFile')->getData();

            if ($videoFile) {

                $originalFilename = pathinfo(
                    $videoFile->getClientOriginalName(),
                    PATHINFO_FILENAME
                );

                $safeFilename = $slugger->slug(
                    $originalFilename
                );

                $newFilename =
                    $safeFilename . '-' .
                    uniqid() . '.' .
                    $videoFile->guessExtension();

                $videoFile->move(
                    $this->getParameter('videos_directory'),
                    $newFilename
                );

                $video->setVideoFilename($newFilename);
            }

            $entityManager->persist($video);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vidéo uploadée avec succès.'
            );

          return $this->redirectToRoute('video_new', [
    'videos' => $videos,
        ]);
    
        }

        return $this->render('video/new.html.twig', [
            'form' => $form->createView(),
            'videos' => $videos,
        ]);
    }
    #[Route('/videos', name: 'app_video_index')]
public function index(
    VideoRepository $videoRepository
): Response {
    $videos = $videoRepository->findBy(
        [],
        ['id' => 'DESC']
    );

    return $this->render('video/index.html.twig', [
        'videos' => $videos,
    ]);
}
 
}