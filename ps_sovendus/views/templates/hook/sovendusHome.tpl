<script>
    if (['CH', undefined].includes(document.documentElement.lang.split('-')[1]) && window.location.pathname === '/') {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.async = true;
        script.src = "https://api.sovendus.com/js/landing.js";
        document.body.appendChild(script);
    }
</script>