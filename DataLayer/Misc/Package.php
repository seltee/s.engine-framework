<?php
namespace DataLayer\Misc;

class Package extends \Engine\Package {
    public function getConnectionInfo(){
        $getTables = new DataSource\MySQL\GetTables();

        return new Functions\GetDBInfo($getTables);
    }

    public function addTable(){
        return new DataSource\MySQL\AddTable();
    }

    /*
    public function sendMail(){
        return new \DataLayer\Main\Functions\SendMail();
    }

    public function getTemplate(){
        return new \DataLayer\Main\Functions\GetTemplate();
    }

    public function getTemplateAdmin(){
        return new \DataLayer\Main\Functions\GetTemplateAdmin();
    }

    public function getServiceList(){
        return new \DataLayer\Main\DataSource\MySQL\GetServiceList();
    }

    public function getOptions(){
        $getDoctorsByService = new \DataLayer\Main\DataSource\MySQL\GetDoctorsByService();

        return new \DataLayer\Main\Functions\GetOptions($getDoctorsByService);
    }

    public function getDoctorTime(){
        $getAppointmentsOnDay = new \DataLayer\Main\DataSource\MySQL\GetAppointmentsOnDay();
        $getDoctorSchedule = $this->getDoctorSchedule();
        $getDoctorGoodDayByDay = new \DataLayer\Main\DataSource\MySQL\GetSpecialDaysByDay();

        return new \DataLayer\Main\Functions\GetDoctorTime($getAppointmentsOnDay, $getDoctorSchedule, $getDoctorGoodDayByDay);
    }

    public function getDoctorTimeWithPhones(){
        $getAppointmentsOnDay = new \DataLayer\Main\DataSource\MySQL\GetAppointmentsOnDay();
        $getDoctorSchedule = $this->getDoctorSchedule();
        $getDoctorGoodDayByDay = new \DataLayer\Main\DataSource\MySQL\GetSpecialDaysByDay();

        return new \DataLayer\Main\Functions\GetDoctorTime($getAppointmentsOnDay, $getDoctorSchedule, $getDoctorGoodDayByDay, true);
    }

    public function setAppointment(){
        $setAppointment = new \DataLayer\Main\DataSource\MySQL\SetAppointment();
        $getServiceById = new \DataLayer\Main\DataSource\MySQL\GetServiceById();
        $getDoctorById = new \DataLayer\Main\DataSource\MySQL\GetDoctorById();
        $checkCaptcha = new \DataLayer\Main\DataSource\Curl\CheckCaptcha();
        $sendMail = $this->sendMail();

        return new \DataLayer\Main\Functions\SetAppointment($setAppointment,  $getServiceById, $getDoctorById, $checkCaptcha, $sendMail);
    }

    public function getDoctors(){
        return new \DataLayer\Main\DataSource\MySQL\GetDoctors();
    }

    public function getDoctorsByService(){
        return new \DataLayer\Main\DataSource\MySQL\GetDoctorsByService();
    }

    public function getServices(){
        return new \DataLayer\Main\DataSource\MySQL\GetServices();
    }

    public function auth(){
        $getUserByLoginAndPass = new \DataLayer\Main\DataSource\MySQL\GetUserByLoginAndPass();
        return new \DataLayer\Main\Functions\Auth($getUserByLoginAndPass);
    }

    public function setOccupation(){
        return new \DataLayer\Main\DataSource\MySQL\SetOccupation();
    }

    public function removeOccupation(){
        return new \DataLayer\Main\DataSource\MySQL\RemoveOccupation();
    }

    public function removeAppointment(){
        return new \DataLayer\Main\DataSource\MySQL\RemoveAppointment();
    }

    public function addDoctor(){
        return new \DataLayer\Main\DataSource\MySQL\AddDoctor();
    }

    public function editDoctor(){
        return new \DataLayer\Main\DataSource\MySQL\EditDoctor();
    }

    public function removeDoctor(){
        $removeDoctor = new \DataLayer\Main\DataSource\MySQL\RemoveDoctor();
        $removeOccupationByDoctorId = new \DataLayer\Main\DataSource\MySQL\RemoveDoctorOccupationByDoctorId();

        return new \DataLayer\Main\Functions\RemoveDoctor($removeDoctor, $removeOccupationByDoctorId);
    }

    public function setDoctorImage(){
        $setDoctorImage = new \DataLayer\Main\DataSource\MySQL\SetDoctorImage;
        return new \DataLayer\Main\Functions\SetDoctorImage($setDoctorImage);
    }

    public function getAppointmentsOnDay(){
        return new  \DataLayer\Main\DataSource\MySQL\GetAppointmentsOnDay();
    }

    public function addService(){
        return new \DataLayer\Main\DataSource\MySQL\AddService();
    }

    public function editService(){
        return new \DataLayer\Main\DataSource\MySQL\EditService();
    }

    public function removeService(){
        $removeService = new \DataLayer\Main\DataSource\MySQL\RemoveService();
        $removeOccupationByServiceId = new \DataLayer\Main\DataSource\MySQL\RemoveDoctorOccupationByServiceId();

        return new \DataLayer\Main\Functions\RemoveService($removeService, $removeOccupationByServiceId);
    }

    public function getServicesByDoctorId(){
        return new \DataLayer\Main\DataSource\MySQL\GetServicesByDoctorId();
    }

    public function getDoctorSchedule(){
        $getDoctorById = new \DataLayer\Main\DataSource\MySQL\GetDoctorById();
        return new \DataLayer\Main\Functions\GetDoctorSchedule($getDoctorById);
    }

    public function getFutureAppointments(){
        return new \DataLayer\Main\DataSource\MySQL\GetFutureAppointments();
    }

    public function getFutureAppointmentsAll(){
        return new \DataLayer\Main\DataSource\MySQL\GetFutureAppointmentsAll();
    }

    public function setGoodDay(){
        $setGoodDay = new \DataLayer\Main\DataSource\MySQL\SetGoodDay();
        $getAppointmentsOnDay = $this->getAppointmentsOnDay();

        return new \DataLayer\Main\Functions\SetGoodDay($getAppointmentsOnDay, $setGoodDay);
    }

    public function removeGoodDay(){
        return new \DataLayer\Main\DataSource\MySQL\RemoveGoodDay();
    }

    public function setSchedule(){
        $setSchedule = new \DataLayer\Main\DataSource\MySQL\SetSchedule();
        return new \DataLayer\Main\Functions\SetSchedule($setSchedule);
    }

    public function getSpecialDaysByMonth(){
        return new \DataLayer\Main\DataSource\MySQL\GetSpecialDaysByMonth();
    }

    public function getClinics(){
        return new \DataLayer\Main\DataSource\MySQL\GetClinics();
    }

    public function addClinic(){
        return new \DataLayer\Main\DataSource\MySQL\AddClinic();
    }

    public function editClinic(){
        return new \DataLayer\Main\DataSource\MySQL\EditClinic();
    }

    public function removeClinic(){
        return new \DataLayer\Main\DataSource\MySQL\RemoveClinic();
    }

    public function getPage(){
        $getBackupedPage = new \DataLayer\Main\DataSource\MySQL\GetBackupedPage();

        return new \DataLayer\Main\Functions\GetPage($getBackupedPage);
    }

    public function setPage(){
        $getPage = $this->getPage();
        $backupPage = new \DataLayer\Main\DataSource\MySQL\BackupPage();

        return new \DataLayer\Main\Functions\SetPage($getPage, $backupPage);
    }

    public function getBackupsList(){
        return new \DataLayer\Main\DataSource\MySQL\GetBackupsList();
    }

    public function getSystemVariables(){
        return new \DataLayer\Main\Functions\GetSystemVariables();
    }

    public function setSystemVariable(){
        return new \DataLayer\Main\Functions\SetSystemVariable();
    }

    public function setArgumentFile(){
        $argumentFile = new \DataLayer\Main\Functions\SetSystemVariable();
        return new \DataLayer\Main\Functions\SetArgumentFile($argumentFile);
    }
    */
}












