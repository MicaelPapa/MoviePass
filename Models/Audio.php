<?php 
namespace Models;


class Audio {
    private $idAudio;
    private $nameAudio;

    public function setIdAudio($idAudio){
        $this->idAudio = $idAudio;
    }

    public function getIdAudio(){
        return $this->idAudio;
    }
    public function setNameAudio($nameAudio){
        $this->idAudio = $nameAudio;
    }

    public function getNameAudio(){
        return $this->nameAudio;
    }
}
?>