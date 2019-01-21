<?php
declare(strict_types=1);

namespace App\Security;

use App\Form\AdminLoginForm;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

final class AdminLoginAuthenticator extends AbstractFormLoginAuthenticator
{
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var RouterInterface */
    private $router;
    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function getLoginUrl(): string
    {
        return $this->router->generate('admin_login');
    }

    public function supports(Request $request): bool
    {
        return ($request->getPathInfo() === '/admin/login' && $request->getMethod() === 'POST');
    }

    public function getCredentials(Request $request)
    {
        $form = $this->formFactory->create(AdminLoginForm::class);
        $form->handleRequest($request);

        $data = $form->getData();
        $session = $request->getSession();
        if ($session) {
            $session->set(Security::LAST_USERNAME, $data['email']);
        }

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        return $userProvider->loadUserByUsername($credentials['email']);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        if (!$this->passwordEncoder->isPasswordValid($user, $credentials['password'])) {
            return false;
        }

        $roles = $user->getRoles();
        if (!in_array('ROLE_ADMIN', $roles, true)) {
            throw new CustomUserMessageAuthenticationException("You don't have permission to access that page.");
        }

        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
    }

}
