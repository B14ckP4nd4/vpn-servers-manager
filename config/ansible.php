<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Ansible Configs
      |--------------------------------------------------------------------------
      |
      | This Config file Contain the Ansible Configurations
      |
      */

    'default_path' => storage_path('ansible/'),
    'key_path' => storage_path('ansible/keys/'),
    'playbook_path' => storage_path('ansible/playbooks/'),
    'inventories_path' => storage_path('ansible/inventories/'),
    'play_logs_path' => storage_path('ansible/plays/'),
    'default_username' => env('ANSIBLE_USERNAME','root'),
    'default_password' => env('ANSIBLE_PASSWORD','NkxU9gt37Ak8CWhv'),
    'default_configured_username' => env('ANSIBLE_CONFIGURED_USERNAME','masterAnsible'),
    'private_key' => env('ANSIBLE_PRIVATE_KEY','/root/.ssh/ssh_key'),
    'public_key' => env('ANSIBLE_PRIVATE_KEY','ssh-auth.pub'),
];
