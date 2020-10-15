<?php

namespace Models;

class Movies
{
	private $idMovie;
	private $idMovieIMDB;
	private $movieName;
	private $duration;
	private $synopsis;
	private $releaseDate;
	private $photo;
	private $director;
	private $country;
	private $earnings;
	private $budget;
	private $originalLanguage;
    private $clasification;
    private $isPlaying = false;

/**
	 * Getter for IdMovie
	 *
	 * @return [type]
	 */
	public function getIdMovie()
	{
		return $this->idMovie;
	}

	/**
	 * Setter for IdMovie
	 * @var [type] idMovie
	 *
	 * @return self
	 */
	public function setIdMovie($idMovie)
	{
		$this->idMovie = $idMovie;
		return $this;
	}


	/**
	 * Getter for IdMovieIMDB
	 *
	 * @return [type]
	 */
	public function getIdMovieIMDB()
	{
	    return $this->idMovieIMDB;
	}

	/**
	 * Setter for IdMovieIMDB
	 * @var [type] idMovieIMDB
	 *
	 * @return self
	 */
	public function setIdMovieIMDB($idMovieIMDB)
	{
	    $this->idMovieIMDB = $idMovieIMDB;
	    return $this;
	}


	/**
	 * Getter for movieName
	 *
	 * @return [type]
	 */
	public function getMovieName()
	{
	    return $this->movieName;
	}

	/**
	 * Setter for movieName
	 * @var [type] movieName
	 *
	 * @return self
	 */
	public function setMovieName($movieName)
	{
	    $this->movieName = $movieName;
	    return $this;
	}


	/**
	 * Getter for duration
	 *
	 * @return [type]
	 */
	public function getDuration()
	{
	    return $this->duration;
	}

	/**
	 * Setter for Duration
	 * @var [type] duration
	 *
	 * @return self
	 */
	public function setDuration($duration)
	{
	    $this->duration = $duration;
	    return $this;
	}


	/**
	 * Getter for Synopsis
	 *
	 * @return [type]
	 */
	public function getSynopsis()
	{
	    return $this->synopsis;
	}

	/**
	 * Setter for Synopsis
	 * @var [type] synopsis
	 *
	 * @return self
	 */
	public function setSynopsis($synopsis)
	{
	    $this->synopsis = $synopsis;
	    return $this;
	}


	/**
	 * Getter for ReleaseDate
	 *
	 * @return [type]
	 */
	public function getReleaseDate()
	{
	    return $this->releaseDate;
	}

	/**
	 * Setter for ReleaseDate
	 * @var [type] releaseDate
	 *
	 * @return self
	 */
	public function setReleaseDate($releaseDate)
	{
	    $this->releaseDate = $releaseDate;
	    return $this;
	}


	/**
	 * Getter for Photo
	 *
	 * @return [type]
	 */
	public function getPhoto()
	{
	    return $this->photo;
	}

	/**
	 * Setter for Photo
	 * @var [type] Photo
	 *
	 * @return self
	 */
	public function setPhoto($photo)
	{
	    $this->photo = $photo;
	    return $this;
	}


	/**
	 * Getter for Director
	 *
	 * @return [type]
	 */
	public function getDirector()
	{
	    return $this->director;
	}

	/**
	 * Setter for Director
	 * @var [type] director
	 *
	 * @return self
	 */
	public function setDirector($director)
	{
	    $this->director = $director;
	    return $this;
	}


	/**
	 * Getter for Country
	 *
	 * @return [type]
	 */
	public function getCountry()
	{
	    return $this->country;
	}

	/**
	 * Setter for Country
	 * @var [type] country
	 *
	 * @return self
	 */
	public function setCountry($country)
	{
	    $this->country = $country;
	    return $this;
	}


	/**
	 * Getter for Earnings
	 *
	 * @return [type]
	 */
	public function getEarnings()
	{
	    return $this->earnings;
	}

	/**
	 * Setter for Earnings
	 * @var [type] earnings
	 *
	 * @return self
	 */
	public function setEarnings($earnings)
	{
	    $this->earnings = $earnings;
	    return $this;
	}


	/**
	 * Getter for Budget
	 *
	 * @return [type]
	 */
	public function getBudget()
	{
	    return $this->budget;
	}

	/**
	 * Setter for Budget
	 * @var [type] budget
	 *
	 * @return self
	 */
	public function setBudget($budget)
	{
	    $this->budget = $budget;
	    return $this;
	}
	/**
	 * Getter for OriginalLanguage
	 *
	 * @return [type]
	 */
	public function getOriginalLanguage()
	{
	    return $this->originalLanguage;
	}

	/**
	 * Setter for Budget
	 * @var [type] budget
	 *
	 * @return self
	 */
	public function setOriginalLanguage($originalLanguage)
	{
	    $this->originalLanguage = $originalLanguage;
	    return $this;
	}



	/**
	 * Getter for Clasification
	 *
	 * @return [type]
	 */
	public function getClasification()
	{
	    return $this->clasification;
	}

	/**
	 * Setter for Clasification
	 * @var [type] clasification
	 *
	 * @return self
	 */
	public function setClasification($clasification)
	{
	    $this->clasification = $clasification;
	    return $this;
	}
	/**
	 * Getter for IsPlaying
	 *
	 * @return [type]
	 */
	public function getIsPlaying()
	{
	    return $this->isPlaying;
	}

	/**
	 * Setter for IsPlaying
	 * @var [type] isPlaying
	 *
	 * @return self
	 */
	public function setIsPlaying($isPlaying)
	{
	    $this->isPlaying = $isPlaying;
	    return $this;
	}
}
?>