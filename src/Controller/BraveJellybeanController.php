<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BraveJellybeanController extends AbstractController
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/brave/jellybean", name="brave_jellybean")
     */
    public function index()
    {
        $this->logger->notice('Brave jellybean is called');

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BraveJellybeanController.php',
        ]);
    }
}
