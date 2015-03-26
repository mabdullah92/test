<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Pe for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pe\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Pe\Entity\Readings;
use Pe\Model\ReadingsModel;
use Zend\Session\Container;

class PeController extends AbstractActionController
{
    private function disableLayout()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariables(array('key' => 'value'))->setTerminal(true);
        return $viewModel;
    }

    private function getReq()
    {
        $request = $this->getRequest();
        return $request;
    }

    private function getDm()
    {
        $dm = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        return $dm;
    }

    public function tokendeviceAction()
    {
        $device_session = new Container('device');
        if ($device_session->device == null) {
            $device_session->device = 1;
        }
        if ($this->_request->isPost) {
            $device_session->device = $this->getReq()->getPost('dd_device');
        } else {
            echo $device_session->device;
        }
        return $this->disableLayout();
    }

    public function tokenauthAction()
    {
        $auth_session = new Container('auth');
        if ($this->_request->isPost) {
            $auth_session->username = $this->getReq()->getPost('login_name');;
        } else {
            echo $auth_session->username;
        }
        return $this->disableLayout();
    }

    public function submitAction()
    {
        $data = $this->getReq()->getPost();
        $dm = $this->getDm();
        $class = 'Pe\Model\\' . $data["iamM"] . 'Model';
        $method = 'strom' . $data["iamO"];
        $model = new $class();
        //$data=array("Temperature"=>10,"Humidity"=>9,"Device_Id"=>1);
        echo $model->$method($dm, $data);

        return $this->getResponse();
    }

    public function indexAction()
    {
        return array();
    }

    public function dashboardAction()
    {
        return $this->disableLayout();
    }

    public function livetempAction()
    {
        return $this->disableLayout();
    }

    public function livehumidAction()
    {
        return $this->disableLayout();
    }

    public function datatablesAction()
    {
        return $this->disableLayout();
    }


}
