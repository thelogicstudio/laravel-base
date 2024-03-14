<?php

    namespace App\Policies;

    use App\Models\User;
    use Illuminate\Auth\Access\HandlesAuthorization;
    use Illuminate\Auth\Access\Response;

    class UserPolicy {
        use HandlesAuthorization;

        public function index(User $user): bool {
            return $user->allowedTo('do_all_action_user') || $user->allowedTo('index_user');
        }

        /**
         * Determine whether the User can view any models.
         *
         * @param User $user
         * @return bool
         */
        public function viewAny(User $user): bool {
            return $user->allowedTo('do_all_action_user') || $user->allowedTo('index_user');
        }

        /**
         * Determine whether the User can view the model.
         *
         * @param User $user
         * @return bool
         */
        public function show(User $user): bool {
            return $user->allowedTo('do_all_action_user') || $user->allowedTo('show_user');
        }

        /**
         * Determine whether the User can create models.
         *
         * @param User $user
         * @return bool
         */
        public function create(User $user): bool {
            // return true;
            return $user->allowedTo('do_all_action_user') || $user->allowedTo('create_user');
        }

        /**
         * Determine whether the User can update the model.
         *
         * @param User $user
         * @return bool
         */
        public function update(User $user): bool {
            // return true;
            return $user->allowedTo('do_all_action_user') || $user->allowedTo('update_user');
        }

        /**
         * Determine whether the User can delete the model.
         *
         * @param User $user
         * @return bool
         */
        public function delete(User $user): bool {
            return $user->allowedTo('do_all_action_user') || $user->allowedTo('delete_user');
        }

        /**
         * Determine whether the User can restore the model.
         *
         * @param User $user
         * @return bool
         */
        public function restore(User $user): bool {
            return $user->allowedTo('do_all_action_user') || $user->allowedTo('restore_user');
        }

        /**
         * Determine whether the User can permanently delete the model.
         *
         * @param User $user
         * @return Response|bool
         */
        public function forceDelete(User $user): Response|bool {
            return $user->allowedTo('do_all_action_user') ?: $user->isAdmin();
        }
    }
