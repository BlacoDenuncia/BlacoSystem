<nav class="bottom-nav container-fluid">
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class=" <?php echo ($current_page === 'index') ? 'active' : 'text-white'; ?>" href="Index_controller">
        		<i class="bi bi-house"></i>
				<p class="menu-text">Início</p>
			</a>
		</div>
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="<?php echo ($current_page === 'mapa') ? 'active' : 'text-white'; ?>" href="Mapa_controller">
			<i class="bi bi-map"></i>
				<p class="menu-text">Mapa</p>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">		
		<div class="bottom-nav-item-content">
			<a class="text-white" href="tel:197">
            	<i class="bi bi-telephone"></i>
				<p class="menu-text">Emergênca</p>
			</a>
		</div>
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class=" <?php echo ($current_page === 'boletim') ? 'active' : 'text-white'; ?>" href="Boletim_controller">
				<i class="bi bi-exclamation-octagon"></i>
				<p class="menu-text">Denuncie</p>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class=" <?php echo ($current_page === 'conteudo') ? 'active' : 'text-white'; ?>" href="Conteudo_controller">
				<i class="bi bi-book-half"></i>
				<p class="menu-text">Aprenda</p>
			</a>
		</div>		
	</div>
</nav>
