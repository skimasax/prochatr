<?php

use Socialite;

// ...

/**
 * Redirect the user to the provider authentication page.
 *
 * @return \Illuminate\Http\Response
 */
public function redirectToProvider($driver)
{
    return Socialite::driver($driver)->redirect();
};