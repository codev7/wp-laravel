<?php
namespace CMV\Misc;

/**
 * Class HashIds
 * @package CMV\Misc
 */
class HashIds {

    protected $salt = 'kdki*idk2KJK(@11!*7';

    /**
     * @var \Hashids\Hashids
     */
    protected $hashids;

    public function __construct()
    {
        $this->hashids = new \Hashids\Hashids($this->salt, 9, "0123456789thequickbrownfoxjumpsoverthelazydog");
    }

    public function encode(array $ids)
    {
        return $this->hashids->encode($ids);
    }

    public function decode($hash)
    {
        return $this->hashids->decode($hash);
    }

}