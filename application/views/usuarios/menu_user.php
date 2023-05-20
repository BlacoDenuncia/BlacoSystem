<nav class="bottom-nav container-fluid">
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-dark <?php echo ($current_page === 'index') ? 'active' : ''; ?>" href="Index_controller">
        		<i class="bi bi-house"></i>
				<p class="menu-text">Início</p>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">		
		<div class="bottom-nav-item-content">
			<a class="link-dark" href="tel:197">
            	<i class="bi bi-telephone"></i>
				<p class="menu-text">Emergênca</p>
			</a>
		</div>
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-dark <?php echo ($current_page === 'boletim') ? 'active' : ''; ?>" href="Boletim_controller">
				<i class="bi bi-exclamation-octagon"></i>
				<p class="menu-text">Denuncie</p>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-dark <?php echo ($current_page === 'conteudo') ? 'active' : ''; ?>" href="Conteudo_controller">
				<i class="bi bi-book-half"></i>
				<p class="menu-text">Aprenda</p>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-dark <?php echo ($current_page === 'conta') ? 'active' : ''; ?>" href="Conta_controller">
				<i class="bi bi-person-circle"></i>
				<p class="menu-text">Conta</p>
			</a>
		</div>		
	</div>
</nav>
