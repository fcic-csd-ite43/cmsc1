
			<?php
			
					if (!$_POST['submit']){
					// form not submitted
					?>
			<p class="search">
			<form action="" method="post" name="frmSearch" id="frmSearch">
				ID<input name="idSearch" type="radio" value="1" />
				<input name="txtSearch" type="text" id="txtSearch" size="20" />
				
				<input name="submit" type="submit" onClick="searchFailed();" id="submit"
				value="search" 
				/>
                <select name="cboCategory" class="box" id="cboCategory " onChange="viewProduct();">
     				<option selected>Select User Type</option>
						<option value="1">Admin</option>
					   <option value="3">User</option>
  				 </select>
			</form>
			<?php
			} else {
				$searchText = $_POST['txtSearch'];
				$idText = $_POST['idSearch'];
				//$sem = $_POST['semSearch'];
				//$sy = $_POST['sySearch'];
				}
			?>
			</p>