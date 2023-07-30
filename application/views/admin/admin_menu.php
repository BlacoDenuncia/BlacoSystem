<nav class="bottom-nav container-fluid">
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-white <?php echo ($current_page === 'index_admin') ? 'active' : ''; ?>" href="Conta_controller">
        		<i class="bi bi-clipboard-data"></i>
				<p class="menu-text">Dashboard</p>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-white <?php echo ($current_page === 'relatorios') ? 'active' : ''; ?>" href="Relatorios_controller">
				<i class="bi bi-pie-chart-fill"></i>
				<p class="menu-text">Relátórios</p>
			</a>
		</div>		
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-danger <?php echo ($current_page === 'sair') ? 'active' : ''; ?>" id="fazerLogout">
				<i class="bi bi-box-arrow-right"></i>
				<p class="menu-text">Sair</p>
			</a>
		</div>		
	</div>
</nav>
