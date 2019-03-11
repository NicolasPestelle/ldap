</div>
          
          <nav class="span4">
            <h2>Menu</h2>
            
            <ul>
                <li><a href="index.php">Accueil</a></li>
				<?php
				if($connect == true){
                echo "<li><a href='article.php'>Rédiger un article</a></li>";
				}?>
            </ul>
            
          </nav>
        </div>
        
      </div>

      <footer>
        <p>&copy; Neodar Draenir Kholya 2016</p>

      </footer>

    </div>

  </body>
</html>
