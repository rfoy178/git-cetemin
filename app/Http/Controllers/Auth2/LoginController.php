<?php
namespace App\Http\Controllers\Auth2;
use App\Entidad\TokenCache;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Microsoft\Graph\Graph;
    use Microsoft\Graph\Model;

class LoginController extends Controller
{


    public function signin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Initialize the OAuth client
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                =>'ee57272a-36ba-48e5-9cee-f31158c592fc',
            'clientSecret'            => 'irSYZPU943syhcuTK22*+=#',
            'redirectUri'             => 'https://adm.cetemin.com/authorize',
            'urlAuthorize'            => 'https://login.microsoftonline.com/common'.'/oauth2/v2.0/authorize',
            'urlAccessToken'          => 'https://login.microsoftonline.com/common'.'/oauth2/v2.0/token',
            'urlResourceOwnerDetails' => '',
            'scopes'                  => 'openid profile offline_access User.Read Mail.Read'
        ]);



        // Generate the auth URL
        $authorizationUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in response
        $_SESSION['oauth_state'] = $oauthClient->getState();

        // Redirect to authorization endpoint
        header('Location: '.$authorizationUrl);
        exit();
    }
    public function gettoken()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Authorization code should be in the "code" query param
        if (isset($_GET['code'])) {
            // Check that state matches
            if (empty($_GET['state']) ) {
                exit('State provided in redirect does not match expected value.');
            }

            // Clear saved state
            unset($_SESSION['oauth_state']);

            // Initialize the OAuth client
            $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
                'clientId'                =>'ee57272a-36ba-48e5-9cee-f31158c592fc',
                'clientSecret'            => 'irSYZPU943syhcuTK22*+=#',
                'redirectUri'             => 'https://adm.cetemin.com/authorize',
                'urlAuthorize'            => 'https://login.microsoftonline.com/common'.'/oauth2/v2.0/authorize',
                'urlAccessToken'          => 'https://login.microsoftonline.com/common'.'/oauth2/v2.0/token',
                'urlResourceOwnerDetails' => '',
                'scopes'                  => 'openid profile offline_access User.Read Mail.Read'
            ]);

            try {
                // Make the token request
                $accessToken = $oauthClient->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);

                // Save the access token and refresh tokens in session
                // This is for demo purposes only. A better method would
                // be to store the refresh token in a secured database
                $tokenCache = new TokenCache;
                $tokenCache->storeTokens($accessToken->getToken(), $accessToken->getRefreshToken(),
                    $accessToken->getExpires());

                // Redirect back to mail page
                return redirect()->route('mail');
            }
            catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                exit('ERROR getting tokens: '.$e->getMessage());
            }
            exit();
        }
        elseif (isset($_GET['error'])) {
            exit('ERROR: '.$_GET['error'].' - '.$_GET['error_description']);
        }
    }
    public function mail()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $tokenCache = new TokenCache;




        $graph = new Graph();
        $graph
            ->setBaseUrl("https://graph.microsoft.com/")
            ->setApiVersion("beta")
            ->setAccessToken($tokenCache->getAccessToken());

        $user = $graph->createRequest("get", "/me")
            ->addHeaders(array("Content-Type" => "application/json"))
            ->setReturnType(Model\User::class)
            ->setTimeout("1000")
            ->execute();



        $datos=User::where("email",$user->getMail())->first();

        if($datos){


            Auth::login($datos);

            return redirect()->route('rq.index');

        }else{

            return response()->view('errors.403');
        }




    }
}