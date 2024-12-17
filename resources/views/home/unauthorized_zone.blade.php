<!DOCTYPE html>
<html lang="{{ $Language }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icono-->
    <link rel="icon" href="{{ asset($CompanyLogoIcon) }}" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset($ColorNightAndDay) }}">
    <link rel="stylesheet" href="{{ asset($TemplateDesktop) }}">
    <link rel="stylesheet" href="{{ asset($TemplateMobile) }}">
    <link rel='stylesheet' href="{{ asset($Boxicons) }}">
    <link rel='stylesheet' href="{{ asset($IconReferen) }}">
    <link rel='stylesheet' href="{{ asset($MozoStylePanel) }}">
    <link rel='stylesheet' href="{{ asset($AccessDenied) }}">

    <script src="{{ asset($JquerySrc) }}"></script>
    <script src="{{ asset($FunctionGlobal) }}"></script>

    <title>D'Brazza</title>
</head>

<body class="{{ session('theme', 'light') }}">
    <div class="container-primary">
        <div class="sub-container-00">
            <h1 class="title">{{ session('access_denied_info.title') }}</h1>
        </div>
        <div class="sub-container-01">
            <div class="loader">
                <div class="wrapper">
                    <div class="catContainer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 733 673" class="catbody">
                            <path class="cat"  d="M111.002 139.5C270.502 -24.5001 471.503 2.4997 621.002 139.5C770.501 276.5 768.504 627.5 621.002 649.5C473.5 671.5 246 687.5 111.002 649.5C-23.9964 611.5 -48.4982 303.5 111.002 139.5Z"></path>
                            <path class="cat"  d="M184 9L270.603 159H97.3975L184 9Z"></path>
                            <path class="cat"  d="M541 0L627.603 150H454.397L541 0Z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 158 564" class="tail">
                            <path class="cat-col" fill="#191919" d="M5.97602 76.066C-11.1099 41.6747 12.9018 0 51.3036 0V0C71.5336 0 89.8636 12.2558 97.2565 31.0866C173.697 225.792 180.478 345.852 97.0691 536.666C89.7636 553.378 73.0672 564 54.8273 564V564C16.9427 564 -5.4224 521.149 13.0712 488.085C90.2225 350.15 87.9612 241.089 5.97602 76.066Z"></path>
                        </svg>
                        <div class="text">
                            <span class="bigzzz">Z</span>
                            <span class="zzz">Z</span>
                        </div>
                    </div>
                    <div class="wallContainer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 500 126" class="wall">
                            <line stroke-width="6" stroke="#7C7C7C" y2="3" x2="450" y1="3" x1="50"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="85" x2="400" y1="85" x1="100"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="122" x2="375" y1="122" x1="125"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="43" x2="500" y1="43"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="1.99391" x2="115.5" y1="43.0061" x1="115.5"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="2.00002" x2="189" y1="43.0122" x1="189"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="2.00612" x2="262.5" y1="43.0183" x1="262.5"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="2.01222" x2="336" y1="43.0244" x1="336"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="2.01833" x2="409.5" y1="43.0305" x1="409.5"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="43" x2="153" y1="84.0122" x1="153"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="43" x2="228" y1="84.0122" x1="228"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="43" x2="303" y1="84.0122" x1="303"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="43" x2="378" y1="84.0122" x1="378"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="84" x2="192" y1="125.012" x1="192"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="84" x2="267" y1="125.012" x1="267"></line>
                            <line stroke-width="6" stroke="#7C7C7C" y2="84" x2="342" y1="125.012" x1="342"></line>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-container-02">

            @if (session('access_denied_info.intentedUrl'))
                <p class="router"> <span class="span-sub-title">Intentas acceder a:</span> {{ session('access_denied_info.intentedUrl') }}</p>
            @endif
            @if (session('access_denied_info.routeName'))
                <p class="router">Comuniquese con un administrador para que le de el permiso a {{ session('access_denied_info.routeName') }}</p>
            @endif

        </div>
        <a class="button-retur" href="{{route('home')}}">Regresar al Home</a>
    </div>

</body>

</html>
