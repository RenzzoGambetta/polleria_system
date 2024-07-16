<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include('{{ asset($HeaderPanel) }}')
<!---------------------------------------------------------------------->
<h1>Bienvenido al area de la lista de Cargos</h1>
<h2>Los datos de prueva an sido enviado con exito</h2>
<h3>Nombre de Usuario: {{ auth()->user()->username }}</h3>
<h3>Contraseña; {{ auth()->user()->password }}</h3>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include('{{ asset($FooterPanel) }}')
<!------------------------------------------------------------>
