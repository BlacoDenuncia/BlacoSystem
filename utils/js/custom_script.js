// Mudar a cor dos itens do menu ao serem selcecionados
var bottomNavItems = document.querySelectorAll('.bottom-nav-item'); 
    var activeItem = null;

    bottomNavItems.forEach(function(item) {
      item.addEventListener('click', function() {
        var icon = this.querySelector('i');
        
        if (activeItem !== null) {
          activeItem.querySelector('i').classList.remove('red');
        }

        icon.classList.add('red');
        activeItem = this;
      });
});