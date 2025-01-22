<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@php
   $user = Auth::user();
    if ($user && $user->role) {
        $userPermissions = $user->role->permissions->pluck('id');
    } else {
        $userPermissions = collect();
    }
@endphp
    @if(($userPermissions->contains(6) || $userPermissions->contains(5)) && !$userPermissions->contains(1))
        @include($HeaderMozo)
    @else
        @include($HeaderPanel)
    @endif
<!---------------------------------------------------------------------->
<style>
    .content main .header {
    display: flex
;
    align-items: center;
    justify-content: center;
    grid-gap: 16px;
    flex-wrap: wrap;
    width: 100%;
    height: 100%;
}.left {
    display: flex
;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}.content main .header .left h1 {
    font-size: 5rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--dark);
}
.content main .header .left .breadcrumb {
    display: flex
;
    align-items: center;
    grid-gap: 16px;
    font-size: 1.4rem;
}
</style>
<div class="header">
    <div class="left">
        <h1>Bienvenido {{Auth::user()->employee->person->name ?? Auth::user()->username}} </h1>
        <ul class="breadcrumb">
            <li><a href="#">
                    Home
                </a></li>
            <li>-></li>
            <li><a href="#" class="active">{{Auth::user()->role->name ?? 'Comuniquese con un administrador para recibir un rol'}}</a></li>
        </ul>
    </div>
    
</div>


</div>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
