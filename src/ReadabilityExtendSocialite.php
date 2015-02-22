<?php
namespace SocialiteProviders\Readability;

use SocialiteProviders\Manager\SocialiteWasCalled;

class ReadabilityExtendSocialite
{
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'readability',
            __NAMESPACE__.'\Provider',
            __NAMESPACE__.'\Server'
        );
    }
}
