<?php namespace Illuminate\Hashing;

class Sha1Hasher implements HasherInterface {

	public function make($value, array $options = array())
	{
                return sha1($value);
	}

	public function check($value, $hashedValue, array $options = array())
	{
		return $hashedValue == $this->make($value);
	}

	public function needsRehash($hashedValue, array $options = array())
	{
                return strlen($hashedValue) != 40;
	}

}