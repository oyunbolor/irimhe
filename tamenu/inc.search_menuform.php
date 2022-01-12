
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Хайлтын хэсэг</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><form class="form-horizontal" action="<?php echo $my_url; ?>" method="post" name="mainform" id="mainform">
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-5 control-label">Мэдээний төрөл:</label>
                <div class="col-md-5">
                  <?php
						echo seldata("daily_type", "form-control", $DAILY_TYPE, $daily_type, "", "Бүх төрөл");
						?>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <?php
				if($db->isGroupRole($sess_profile, $sess_user_id, 17, 2))
				{
				?>
              <div class="form-group info">
                <label class="col-md-5 control-label">Мэдээ оруулсан хэрэглэгчийн нэр:</label>
                <div class="col-md-5">
                  <?php
						if($sess_profile==1)
							$selQuery = "SELECT tau.user_id, tau.name FROM user tau ORDER BY tau.profile, tau.name";
						else
							$selQuery = "SELECT tau.user_id, tau.name FROM user tau WHERE tau.user_id = ".$sess_user_id." ORDER BY tau.profile, tau.name";
		
						$row = $db->query($selQuery);
						echo seldatadb("user_id", "form-control", $row, "user_id", "name",  $user_id, "", "Бүх хэрэглэгч");
						?>
                </div>
              </div>
              <?php
				}
				?>
              <?php
				if($sess_profile==1)
				{
				?>
              <div class="form-group info">
                <label class="col-md-5 control-label">Мэдээ оруулсан бүлгийн нэр:</label>
                <div class="col-md-5">
                  <?php
						$selQuery = "SELECT tag.group_id, tag.group_name FROM tagroups tag ORDER BY tag.group_name";
						$row = $db->query($selQuery);
						echo seldatadb("group_id", "form-control", $row, "group_id", "group_name", $group_id, "", "Бүх бүлэг");
						?>
                </div>
              </div>
              <?php
				}
				?>
              <div class="form-group">
                <div class="col-md-2 col-md-offset-8">
                  <button type="submit" class="btn btn-success" name="searchsatellitebttn"><span class="fa fa-search"></span> Хайх</button>
                </div>
              </div>
            </div>
          </form></td>
      </tr>
    </tbody>
  </table>
</div>
