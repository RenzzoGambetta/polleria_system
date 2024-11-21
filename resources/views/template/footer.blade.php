    </main>

    </section>
    @if (session()->has('Console'))
    <!--Console error-->
        <script>console.log('Error en :\n{{session('Console')}}')</script>
    @endif
    <!--Js-->
    <script src="{{ asset($ThemeToggle) }}"></script>
    <script src="{{ asset($Efect) }}"></script>

    </body>

    </html>
