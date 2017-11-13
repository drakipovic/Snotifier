<?php
/**
 * Created by PhpStorm.
 * User: dinorakipovic
 * Date: 08/11/2017
 * Time: 15:20
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Alert;

class AlertController extends Controller
{

    private $locationIDs = array(
        'Brezovica' => '1247', 'Crnomerec' => '1248',
        'Donja Dubrava' => '1249', 'Donji Grad' => '1250',
        'Gornja Dubrava' => '1251', 'Gornji Grad-Medvescak' => '1252',
        'Maksimir' => '1253', 'Novi Zagreb-istok' => '1254',
        'Novi Zagreb-zapad' => '1255', 'Pescenica-Zitnjak' => '1256',
        'Podsljeme' => '1257', 'Podsused-Vrapce' => '1258',
        'Sesvete' => '1259', 'Stenjevec' => '1260',
        'Tresnjevka-Jug' => '1261', 'Tresnjevka-Sjever' => '1262',
        'Trnje' => '1263', 'Zagreb-okolica' => '1264',
        'Zagreb' => '1153',
    );



    /**
     * @Route("/")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAlert(Request $request)
    {
        if($request->getMethod() == "POST") {
            $regions = $request->request->get('regions');
            $minPrice = $request->request->get('fromPrice');
            $maxPrice = $request->request->get('toPrice');

            if(!$regions){
                $regions = array('Zagreb');
            }

            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();

            foreach ($regions as $region){
                $alert = new Alert();
                $alert->setDatetime();
                $alert->setUrl(sprintf('www.njuskalo.hr/iznajmljivanje-stanova?locationId=%s&price[min]=%s&price[max]=%s', $this->locationIDs[$region], $minPrice, $maxPrice));
                $alert->setUserId($user->getId());

                $em->persist($alert);
            }

            $em->flush();

            return $this->redirectToRoute("alerts");
        }

        return $this->render('alert.html.twig');
    }

    /**
     * @Route("/alerts", name="alerts")
     * @Security("has_role('ROLE_USER')")
     */
    public function getAlerts()
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(Alert::class);
        $alerts = $repository->findByUserId($user->getId());

        return $this->render('alerts.html.twig', array('alerts' => $alerts));
    }
}