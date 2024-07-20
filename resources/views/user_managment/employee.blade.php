<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include('template.header')
<!---------------------------------------------------------------------->
<h1>Bienvenido al area de la lista de Enpleados</h1>
<h2>Los datos de prueva an sido enviado con exito</h2>
<h3>Nombre de Usuario: {{ $Data['username'] }}</h3>
<h3>Contraseña; {{ $Data['password'] }}</h3>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include('template.footer')
<!------------------------------------------------------------>
