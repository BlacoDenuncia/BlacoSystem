<nav class="bottom-nav container-fluid">
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-dark <?php echo ($current_page === 'index') ? 'active' : ''; ?>" href="Index_controller">
        		<i class="bi bi-house"></i>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">		
		<div class="bottom-nav-item-content">
			<a class="link-dark" href="tel:197">
            	<i class="bi bi-telephone"></i>
			</a>
		</div>
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-dark <?php echo ($current_page === 'boletim') ? 'active' : ''; ?>" href="Boletim_controller">
				<i class="bi bi-exclamation-octagon"></i>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-dark <?php echo ($current_page === 'conteudo') ? 'active' : ''; ?>" href="Conteudo_controller">
				<i class="bi bi-book-half"></i>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-dark <?php echo ($current_page === 'conta') ? 'active' : ''; ?>" href="Conta_controller">
				<i class="bi bi-person-circle"></i>
			</a>
		</div>		
	</div>
</nav>
