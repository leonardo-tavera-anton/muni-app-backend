<!doctype html>
<html> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Index</title>
    <style>body{font-family:system-ui,Segoe UI,Roboto,Arial;margin:2rem} h1{font-size:1.25rem} ul{line-height:1.6}</style>
  </head>
  <body>
    <h1>LARAVEL</h1>
    <h2>Backend API — Endpoints</h2>
    <p>Click a los endpoints para visualizar la informacion</p>
    <ul>

      <li><a href="{{ url('/api/infos') }}" target="_blank">GET /api/infos</a> — Lista de todos los resultados</li>
      <li><a href="{{ url('/api/usuarios') }}" target="_blank">GET /api/usuarios</a> — Lista de todos los usuarios</li>
    </ul>

    <hr>
    <p>Tip: Para agregar mas rutas ir a <code>routes/web.php</code> o crear un archivo de API.</p>
  </body>
</html>