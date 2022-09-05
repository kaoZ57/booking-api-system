<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Models\Central;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

trait SqlMigrations
{
  public function apiKeyHashing()
  {
    // $hashed_password = str_replace(' ', '', strtolower(crypt(crypt(Auth::user()->id, 'CS#13'), 'BooKinGAIpSYsIlovEPhaYUT') . crypt('API' . Auth::user()->id . 'KEY' . Auth::user()->id, 'I LoVe Xkalux') . '|table'));
    // $hashed_password = password_hash(Auth::user()->id, PASSWORD_ARGON2ID);
    // $hashed_password = substr(password_hash(Auth::user()->id, PASSWORD_ARGON2ID), 33);

    $key =  Auth::user()->create_at;
    $salt = 'Rajamangala University of Technology IsanRajamangala University of Technology Isan CS#13 Booking API System';
    $hashed_password = hash('sha3-256', $salt . $key);
    return $hashed_password;
  }


  public function migration(string $name)
  {

    $name = strtolower($name);
    $hashed_password = $this->apiKeyHashing();

    $user = User::find(Auth::user()->id);

    DB::statement("CREATE DATABASE `$hashed_password` DEFAULT CHARACTER SET utf8");
    $link = mysqli_connect("localhost", "root", "", $hashed_password);
    $sql = array();
    $users = "CREATE TABLE IF NOT EXISTS `users` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `email_verified_at` timestamp NULL DEFAULT NULL, 
                    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    `deleted_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    UNIQUE KEY `users_email_unique` (`email`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";;
    array_push($sql, $users);

    $password_resets = "CREATE TABLE IF NOT EXISTS `password_resets` (
                    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    KEY `password_resets_email_index` (`email`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";;
    array_push($sql, $password_resets);

    $failed_jobs = "CREATE TABLE IF NOT EXISTS `failed_jobs` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `connection` text COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `queue` text COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
                    PRIMARY KEY (`id`), 
                    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";;
    array_push($sql, $failed_jobs);

    $personal_access_tokens = "CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                    `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                    `tokenable_id` bigint(20) unsigned NOT NULL,
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                    `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                    `abilities` text COLLATE utf8mb4_unicode_ci,
                    `last_used_at` timestamp NULL DEFAULT NULL,
                    `created_at` timestamp NULL DEFAULT NULL,
                    `updated_at` timestamp NULL DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
                    KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    array_push($sql, $personal_access_tokens);

    $permissions = "CREATE TABLE IF NOT EXISTS `permissions` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    UNIQUE KEY `permissions_name_guard_name_unique` (`name`, `guard_name`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $permissions);

    $migrations = "CREATE TABLE IF NOT EXISTS `migrations` (
                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
                    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `batch` int(11) NOT NULL, 
                    PRIMARY KEY (`id`)
                  ) ENGINE = InnoDB AUTO_INCREMENT = 18 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $migrations);

    $model_has_permissions =  "CREATE TABLE IF NOT EXISTS `model_has_permissions` (
                    `permission_id` bigint(20) unsigned NOT NULL, 
                    `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `model_id` bigint(20) unsigned NOT NULL, 
                    PRIMARY KEY (
                      `permission_id`, `model_id`, `model_type`
                    ), 
                    KEY `model_has_permissions_model_id_model_type_index` (`model_id`, `model_type`), 
                    CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $model_has_permissions);

    $roles = "CREATE TABLE IF NOT EXISTS `roles` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    `store_id` int(11) NOT NULL DEFAULT '0', 
                    PRIMARY KEY (`id`), 
                    UNIQUE KEY `roles_name_guard_name_unique` (`name`, `guard_name`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $roles);

    $model_has_roles = "CREATE TABLE IF NOT EXISTS `model_has_roles` (
                    `role_id` bigint(20) unsigned NOT NULL, 
                    `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `model_id` bigint(20) unsigned NOT NULL, 
                    PRIMARY KEY (
                      `role_id`, `model_id`, `model_type`
                    ), 
                    KEY `model_has_roles_model_id_model_type_index` (`model_id`, `model_type`), 
                    CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $model_has_roles);

    $role_has_permissions = "CREATE TABLE IF NOT EXISTS `role_has_permissions` (
                    `permission_id` bigint(20) unsigned NOT NULL, 
                    `role_id` bigint(20) unsigned NOT NULL, 
                    PRIMARY KEY (`permission_id`, `role_id`), 
                    KEY `role_has_permissions_role_id_foreign` (`role_id`), 
                    CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE, 
                    CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $role_has_permissions);

    $status = "CREATE TABLE IF NOT EXISTS `status` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $status);

    $store = "CREATE TABLE IF NOT EXISTS `store` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `users_id` bigint(20) unsigned NOT NULL, 
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `is_active` tinyint(4) NOT NULL DEFAULT '0', 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    KEY `store_users_id_foreign` (`users_id`), 
                    CONSTRAINT `store_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $store);

    $tag = "CREATE TABLE IF NOT EXISTS `tag` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `store_id` bigint(20) unsigned NOT NULL, 
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `is_active` tinyint(4) NOT NULL DEFAULT '1', 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    KEY `tag_store_id_foreign` (`store_id`), 
                    CONSTRAINT `tag_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $tag);

    $item = "CREATE TABLE IF NOT EXISTS `item` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `store_id` bigint(20) unsigned NOT NULL, 
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `is_active` tinyint(4) NOT NULL DEFAULT '0', 
                    `is_not_return` tinyint(4) NOT NULL DEFAULT '0', 
                    `updated_by` int(11) NOT NULL DEFAULT '0', 
                    `amount` double(8, 2) NOT NULL DEFAULT '0.00', 
                    `amount_update_at` timestamp NOT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    KEY `item_store_id_foreign` (`store_id`), 
                    CONSTRAINT `item_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $item);

    $tag_item = "CREATE TABLE IF NOT EXISTS `tag_item` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `item_id` bigint(20) unsigned NOT NULL, 
                    `tag_id` bigint(20) unsigned NOT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    KEY `tag_item_item_id_foreign` (`item_id`), 
                    KEY `tag_item_tag_id_foreign` (`tag_id`), 
                    CONSTRAINT `tag_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`), 
                    CONSTRAINT `tag_item_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $tag_item);

    $stock = "CREATE TABLE IF NOT EXISTS `stock` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `item_id` bigint(20) unsigned NOT NULL, 
                    `amount` double(8, 2) NOT NULL DEFAULT '0.00', 
                    `updated_by` int(11) NOT NULL DEFAULT '0', 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    KEY `stock_item_id_foreign` (`item_id`), 
                    CONSTRAINT `stock_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $stock);

    $booking = "CREATE TABLE IF NOT EXISTS `booking` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `users_id` bigint(20) unsigned NOT NULL, 
                    `status_id` bigint(20) unsigned NOT NULL, 
                    `store_id` int(11) NOT NULL, 
                    `start_date` timestamp NULL DEFAULT NULL, 
                    `end_date` timestamp NULL DEFAULT NULL, 
                    `verify_date` timestamp NULL DEFAULT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    KEY `booking_users_id_foreign` (`users_id`), 
                    KEY `booking_status_id_foreign` (`status_id`), 
                    CONSTRAINT `booking_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`), 
                    CONSTRAINT `booking_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $booking);

    $booking_item = "CREATE TABLE IF NOT EXISTS `booking_item` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `booking_id` bigint(20) unsigned NOT NULL, 
                    `item_id` bigint(20) unsigned NOT NULL, 
                    `status_id` bigint(20) unsigned NOT NULL, 
                    `note_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `note_owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `amount` double(8, 2) NOT NULL DEFAULT '1.00', 
                    `updated_by` int(11) NOT NULL DEFAULT '0', 
                    `return_date` timestamp NULL DEFAULT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    KEY `booking_item_booking_id_foreign` (`booking_id`), 
                    KEY `booking_item_item_id_foreign` (`item_id`), 
                    KEY `booking_item_status_id_foreign` (`status_id`), 
                    CONSTRAINT `booking_item_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`), 
                    CONSTRAINT `booking_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`), 
                    CONSTRAINT `booking_item_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $booking_item);

    $customers = "CREATE TABLE IF NOT EXISTS `customers` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `added_by` bigint(20) unsigned NOT NULL, 
                    `updated_by` bigint(20) unsigned DEFAULT NULL, 
                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
                    `deleted_at` timestamp NULL DEFAULT NULL, 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    UNIQUE KEY `customers_name_unique` (`name`), 
                    UNIQUE KEY `customers_surname_unique` (`surname`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $customers);

    $out_of_service = " CREATE TABLE IF NOT EXISTS `out_of_service` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
                    `item_id` bigint(20) unsigned NOT NULL, 
                    `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
                    `amount` double(8, 2) NOT NULL DEFAULT '0.00', 
                    `ready_to_use` tinyint(4) NOT NULL DEFAULT '0', 
                    `updated_by` int(11) NOT NULL DEFAULT '0', 
                    `created_at` timestamp NULL DEFAULT NULL, 
                    `updated_at` timestamp NULL DEFAULT NULL, 
                    PRIMARY KEY (`id`), 
                    KEY `out_of_service_item_id_foreign` (`item_id`), 
                    CONSTRAINT `out_of_service_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
                  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;";
    array_push($sql, $out_of_service);

    foreach ($sql as $value) {
      $query = mysqli_query($link, $value);
    }
    if ($query) {
      $central = Central::create([
        'user_id' => Auth::user()->id,
        'api_key' => $hashed_password,
      ]);
      config(['database.connections.mysql.database' => $hashed_password]);
      DB::purge('mysql');
      $ownerUser =   User::create([
        'name'  => $user->name,
        'email' => $user->email,
        'password' => $user->password
      ]);
      $roles = array(
        array(
          'name' => 'owner',
          'guard_name' => 'api'
        ),
        array(
          'name' => 'staff',
          'guard_name' => 'api'
        ),
        array(
          'name' => 'customer',
          'guard_name' => 'api'
        ),
      );
      Role::insert($roles);
      $roleOwner = Role::findOrCreate('owner', 'api');
      $roleCustomer  = Role::findOrCreate('customer', 'api');
      $ownerUser->assignRole([$roleOwner, $roleCustomer]);
      Store::create([
        'users_id' => $ownerUser->id,
        'name' => $name,
        'is_active' => 1
      ]);
      DB::table('status')->insert([
        [
          'name' => '101 prepairing',
          'table_name' => 'booking'
        ],
        [
          'name' => '102 pending',
          'table_name' => 'booking'
        ],
        [
          'name' => '103 approve',
          'table_name' => 'booking'
        ],
        [
          'name' => '104 complete',
          'table_name' => 'booking'
        ],
        [
          'name' => '201 reject',
          'table_name' => 'booking_item'
        ],
        [
          'name' => '202 pending',
          'table_name' => 'booking_item'
        ],
        [
          'name' => '203 approve',
          'table_name' => 'booking_item'
        ],
        [
          'name' => '204 lending',
          'table_name' => 'booking_item'
        ],
        [
          'name' => '205 returned',
          'table_name' => 'booking_item'
        ],
      ]);
      return response()->json([
        'name' => $central->name,
        'api_key' => $hashed_password,
        'owner' => $ownerUser
      ]);
    }
    return response()->json([
      'name' => '',
      'api_key' => '',
      'owner' => ''
    ]);
  }
}
