<?php
/**
 * Implements same interface as users to allow batch pocessing.
 */
class MultiproviderUser {
  protected $providers;
  protected $user;

  public function __construct(User $user, array $providers)
  {
    lmb_assert_true(count($providers));
    $this->user      = $user;
    $this->providers = $providers;
  }

  public function getProviders()
  {
    return $this->providers;
  }

  public function getProvider($provider)
  {
    return $this->providers[$provider];
  }

  public function getUser()
  {
    return $this->user;
  }

  public function __call($function_name, $function_arguments)
  {
    foreach ($this->getProviders() as $provider_name => $provider) {
      if(method_exists($provider, $function_name)) {
        return call_user_func_array(array($provider, $function_name), $function_arguments);
      } else {
        throw new lmbException("Method '{$function_name}' is not implemented in provider '{$provider_name}'.");
      }
    }
  }
}
