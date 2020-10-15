<?php
    namespace Controllers;

    use Models\Room as Room;
    use Models\Cinema as Cinema;
    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Util\Validate as Validate;
    use Controllers\HomeController as HomeController;
    use Controllers\CinemaController as CinemaController;

    class RoomController 
    {
        private $roomDAO;
        private $cinemaDAO;
    
        function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
            
        }

        public function Add($roomNumber,$capacity, $cinemaName)
        {
          
            $roomNumber = Validate::ValidateData($roomNumber);
            $capacity = Validate::ValidateData($capacity);
           
            $cinema = new Cinema();
            $cinema = $this->cinemaDAO->getCinemaByName($cinemaName);
           
            $room = new Room();
            $room->setRoomNumber($roomNumber);
            $room->setCapacity($capacity);

            $this->roomDAO->Add($room,$cinema); 
        
            $cinemaList = $this->cinemaDAO->GetAll();

            require_once(VIEWS_PATH . "CinemaListView.php");
           

        }

        public static  function ShowAddView($cinema)
        {  
      
                require_once(VIEWS_PATH . "AddRoomView.php");

                //CinemaController::ShowCinemaList();     
        }


        public function ShowListView($idCinema)
        {

            $roomList = $this->roomDAO->GetRoomByCinema($idCinema);
            
            require_once(VIEWS_PATH . "RoomListView.php");
           //tengo borrar que es el action del form, tengo volver al cinema list o agregar una sala
            //agregas una nueva sala y vas a  list luego, si tocas remover volves aca  y  si tocas siguiente vas a :
        
            
           // CinemaController::ShowCinemaList();
        }

        public function Remove($idRoom)
        {    
           
            $idRoom = Validate::ValidateData($idRoom);
            $room = new Room();
            $room->setIdRoom($idRoom);
            $room = $this->roomDAO->getRoomNumber($room);
            $idCine = $room->getIdCine();
            
            CinemaController::ShowListView();
          
        }
      
    }
