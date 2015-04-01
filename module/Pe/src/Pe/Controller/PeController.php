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
use Pe\Model\ReadingsModel;
use Pe\Model\DevicesModel;
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
        echo $model->$method($dm, $data);
        return $this->getResponse();
    }

    public function testAction()
    {
        $dm = $this->getDm();
        $model = new ReadingsModel();
        $data = $model->stromCharts($dm, $data);
        echo $data;
        return $this->getResponse();
    }

    public function indexAction()
    {
        return array();
    }

    public function dashboardAction()
    {
        $tiles = "";
        $arr = array();
        $dm = $this->getDm();
        $model = new DevicesModel();
        $data = $model->stromFindDevice($dm);
        $data = json_decode($data);
        foreach ($data as $d) {
            $d = json_decode(json_encode($d), true);
            foreach ($d as $s) {
                $tiles .= '<div id="s' . $s["Device_Id"] . '" class="tile double bg-green-meadow" onclick="rmAlert(this);">
                <div class="tile-body">
                    <img src="../../assets/admin/pages/media/profile/photo1.png" alt="">
                    <h4>' . $s["Device_Loc"] . '</h4>
                    <br>
                    <p style="  font-size:14px;">
                        Temperature : <span id="s' . $s["Device_Id"] . 't">...</span> °C <br>   <br>Relative Humidity : <span id="s' . $s["Device_Id"] . 'h">...</span> %
                    </p>
                </div>
                <div class="tile-object">
                    <div class="name">
                    </div>
                    <div class="number">
                        Status: <span id="s' . $s["Device_Id"] . 'Status">Controlled Conditions</span>
                    </div>
                </div>
            </div>';
                $tiles .= '<div id="s' . $s["Device_Id"] . '" class="tile double bg-green-meadow" onclick="rmAlert(this);">
                <div class="tile-body">
                    <img src="../../assets/admin/pages/media/profile/photo1.png" alt="">
                    <h4>' . $s["Device_Loc"] . '</h4>
                    <br>
                    <p style="  font-size:14px;">
                        Temperature : <span id="s' . $s["Device_Id"] . 't">...</span> °C <br>   <br>Relative Humidity : <span id="s' . $s["Device_Id"] . 'h">...</span> %
                    </p>
                </div>
                <div class="tile-object">
                    <div class="name">
                    </div>
                    <div class="number">
                        Status: <span id="s' . $s["Device_Id"] . 'Status">Controlled Conditions</span>
                    </div>
                </div>
            </div>';
                $tiles .= '<div id="s' . $s["Device_Id"] . '" class="tile double bg-green-meadow" onclick="rmAlert(this);">
                <div class="tile-body">
                    <img src="../../assets/admin/pages/media/profile/photo1.png" alt="">
                    <h4>' . $s["Device_Loc"] . '</h4>
                    <br>
                    <p style="  font-size:14px;">
                        Temperature : <span id="s' . $s["Device_Id"] . 't">...</span> °C <br>   <br>Relative Humidity : <span id="s' . $s["Device_Id"] . 'h">...</span> %
                    </p>
                </div>
                <div class="tile-object">
                    <div class="name">
                    </div>
                    <div class="number">
                        Status: <span id="s' . $s["Device_Id"] . 'Status">Controlled Conditions</span>
                    </div>
                </div>
            </div>';
                $tiles .= '<div id="s' . $s["Device_Id"] . '" class="tile double bg-green-meadow" onclick="rmAlert(this);">
                <div class="tile-body">
                    <img src="../../assets/admin/pages/media/profile/photo1.png" alt="">
                    <h4>' . $s["Device_Loc"] . '</h4>
                    <br>
                    <p style="  font-size:14px;">
                        Temperature : <span id="s' . $s["Device_Id"] . 't">...</span> °C <br>   <br>Relative Humidity : <span id="s' . $s["Device_Id"] . 'h">...</span> %
                    </p>
                </div>
                <div class="tile-object">
                    <div class="name">
                    </div>
                    <div class="number">
                        Status: <span id="s' . $s["Device_Id"] . 'Status">Controlled Conditions</span>
                    </div>
                </div>
            </div>';
            }
        }
        $viewModel = new ViewModel();
        $viewModel->setVariables(array('tiles' => $tiles))->setTerminal(true);
        return $viewModel;
    }

    public function liveviewAction()
    {
        return $this->disableLayout();
    }

    public function datatablesAction()
    {
        return $this->disableLayout();
    }


}
