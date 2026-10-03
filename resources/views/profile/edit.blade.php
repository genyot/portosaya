<x-app-layout>

    <!-- PAGE HEADER -->
    <div class="profile-page-header">

        <div>

            <h1 class="profile-page-title">
                Profile
            </h1>

            <p class="profile-page-subtitle">
                Kelola informasi akun dan keamanan profil Anda.
            </p>

        </div>

    </div>


    <!-- PROFILE CONTENT -->
    <div class="profile-container">

        <!-- PROFILE INFORMATION -->
        <div class="profile-section">

            @include('profile.partials.update-profile-information-form')

        </div>


        <!-- UPDATE PASSWORD -->
        <div class="profile-section">

            @include('profile.partials.update-password-form')

        </div>


        <!-- DELETE ACCOUNT -->
        <div class="profile-section">

            @include('profile.partials.delete-user-form')

        </div>

    </div>


    <style>

        /* =========================================
           PROFILE PAGE
        ========================================= */

        .profile-page-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 25px;

        }


        .profile-page-title {

            color: var(--text-primary);

            font-size: 23px;

            font-weight: 600;

            margin: 0 0 5px;

        }


        .profile-page-subtitle {

            color: var(--text-muted);

            font-size: 13px;

            margin: 0;

        }


        /* =========================================
           PROFILE CONTAINER
        ========================================= */

        .profile-container {

            display: flex;

            flex-direction: column;

            gap: 20px;

        }


        .profile-section {

            width: 100%;

        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 768px) {

            .profile-page-title {

                font-size: 20px;

            }


            .profile-page-subtitle {

                font-size: 12px;

            }

        }

    </style>

</x-app-layout>