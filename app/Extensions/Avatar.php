<?php


namespace StickIt\Extensions;


use StickIt\User;
use Intervention\Image\Image;
use Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Avatar
{
    /**
     * @var User
     */
    private $user;

    /**
     * Banner constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Add Avatar
     * @param UploadedFile $file
     */
    public function add(UploadedFile $file)
    {
        if ($this->has()) $this->remove();

        $name = $this->generateFilename($file);

        $this->uploadAvatar($file, $name);

        $this->user->update(['avatar' => $name]);
    }

    /**
     * Remove Avatar
     */
    public function remove()
    {
        if (!$this->has()) return true;

        Storage::drive()->delete("uploads/avatars/{$this->user->avatar}");

        $this->user->update(['avatar' => null]);

        return true;
    }

    /**
     * Check is user has avatar already
     * @return bool
     */
    public function has()
    {
        return (bool)($this->user->avatar);
    }

    /**
     * Avatar Url
     * @return mixed
     */
    public function url()
    {
        return ($this->has()) ? url("/uploads/avatars/{$this->user->avatar}") : $this->default_url();
    }

    /**
     * Default Avatar
     * @return mixed
     */
    public function default_url()
    {
        return url('/uploads/avatars/default.png');
    }

    /**
     * Upload avatar
     * @param UploadedFile $file
     * @param $name
     */
    protected function uploadAvatar(UploadedFile $file, $name)
    {
        $img = \Image::make($file);

        Storage::drive()->put("uploads/avatars/{$name}", $this->sortFileBasedOnSizeAndContent($img, $file));

        $img->destroy();
    }

    /**
     * Generate random file name
     * @param UploadedFile $file
     * @return string
     */
    protected function generateFilename(UploadedFile $file)
    {
        return 'avatar_' . time() . str_random('16') . '.' . $file->getClientOriginalExtension();
    }

    /**
     * Returns back file based on it's file type and size
     * @param Image $image
     * @param UploadedFile $file
     * @return string
     */
    protected function sortFileBasedOnSizeAndContent(Image $image, UploadedFile $file)
    {
        return ($file->getClientOriginalExtension() == 'gif' && $image->height() == 100 && $image->width() == 100) ? file_get_contents($file) : $image->fit(100, 100)->stream()->__toString();
    }
}