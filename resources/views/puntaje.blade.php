<div class="puntaje-ac">
    <div class="puntaje-ac-text-cont">
        <p class="text-puntaje-ac">PUNTAJE ACUMULADO <span>{{ Auth::user()->puntos }} PTS</span></p>
        <p class="text-puntaje-pen">PUNTAJE PENDIENTE <span>{{ Auth::user()->pendientes(Auth::user()->id) }} PTS</span></p>
    </div> 
</div>