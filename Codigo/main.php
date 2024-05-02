<html>
<head>
    <title>Capturar Informacion Biometrico</title>
</head>

<body>
<?php
    $enableGetDeviceInfo = true;
    $enableGetUsers = true;
    $enableGetData = true;
	
//===========================================================
	$dispo_id=1;
	$cont_emp=0;
	$cont_mar=0;
	$salida="";
	include("config.php");
//===========================================================
    include('zklib/ZKLib.php');
	
    $zk = new ZKLib(
        '192.168.1.71' //IP DEL DISPOSITIVO
    );
	
	$idemp="";
	$sql="select ifnull(max(emp_codigo),0)as id from tbl_bio_empleado where dispositivo_codigo=1";
	mysqli_set_charset($conexion,"utf8");
	$result1=mysqli_query($conexion,$sql);
	while ($row = mysqli_fetch_assoc($result1)) 
	{
		$id=$row["id"];
	}
    $ret = $zk->connect();
    if ($ret) {
        $zk->disableDevice();
        //$zk->setTime(date('Y-m-d H:i:s')); // Synchronize time
        ?>
        <?php if($enableGetDeviceInfo === true) { ?>
        <table border="1" cellpadding="5" cellspacing="2">
            <tr>
                <td><b>Status</b></td>
                <td>Connected</td>
                <td><b>Version</b></td>
                <td><?php echo($zk->version()); ?></td>
                <td><b>OS Version</b></td>
                <td><?php echo($zk->osVersion()); ?></td>
                <td><b>Platform</b></td>
                <td><?php echo($zk->platform()); ?></td>
            </tr>
            <tr>
                <td><b>Firmware Version</b></td>
                <td><?php echo($zk->fmVersion()); ?></td>
                <td><b>WorkCode</b></td>
                <td><?php echo($zk->workCode()); ?></td>
                <td><b>SSR</b></td>
                <td><?php echo($zk->ssr()); ?></td>
                <td><b>Pin Width</b></td>
                <td><?php echo($zk->pinWidth()); ?></td>
            </tr>
            <tr>
                <td><b>Face Function On</b></td>
                <td><?php echo($zk->faceFunctionOn()); ?></td>
                <td><b>Serial Number</b></td>
                <td><?php echo($zk->serialNumber()); ?></td>
                <td><b>Device Name</b></td>
                <td><?php echo($zk->deviceName()); ?></td>
                <td><b>Get Time</b></td>
                <td><?php echo($zk->getTime()); ?></td>
            </tr>
        </table>
        <?php } ?>
        <hr/>
        <?php if($enableGetUsers === true) { ?>
        <table border="1" cellpadding="5" cellspacing="2" style="float: left; margin-right: 10px;">
            <tr>
                <th colspan="6">Data User</th>
            </tr>
            <tr>
                <th>UID</th>
                <th>ID</th>
                <th>Name</th>
                <th>Card #</th>
                <th>Role</th>
                <th>Password</th>
            </tr>
            <?php
            try {
                $users = $zk->getUser();
                sleep(1);
                foreach ($users as $uItem) {
//========================================================================
					$idu=$uItem['userid'];
					$nom=$uItem['name'];
					$cel=$uItem['password'];
					
					$idemp="";
					$c=0;
					$celu="";
					$sql="select count(*)as c,ifnull(emp_celular,'')as cel from tbl_bio_empleado where dispositivo_codigo=".$dispo_id." and emp_codigo=".$idu;
					mysqli_set_charset($conexion,"utf8");
					$result1=mysqli_query($conexion,$sql);
					while ($row = mysqli_fetch_assoc($result1)) 
					{
						$c=$row["c"];
						$celu=$row["cel"];
					}
//========================================================================
					?>
                    <tr>
                        <td><?php echo($uItem['uid']); ?></td>
                        <td><?php echo($uItem['userid']); ?></td>
                        <td><?php echo($uItem['name']); ?></td>
                        <td><?php echo($uItem['cardno']); ?></td>
                        <td><?php echo(ZK\Util::getUserRole($uItem['role'])); ?></td>
                        <td><?php echo($uItem['password']); ?>&nbsp;</td>
                    </tr>
                    <?php
//========================================================================
					if($c==0)
					{
						$sql="insert into tbl_bio_empleado(emp_codigo,emp_nombre,dispositivo_codigo,emp_estado,depto_codigo,emp_celular) values(".
						$idu.",'".$nom."',".$dispo_id.",'ACTIVO',0,'".$cel."')";
						//echo $sql;
						$resultado=mysqli_query($conexion,$sql);
						$cont_emp++;
					}
//========================================================================
                }
            } catch (Exception $e) {
                header("HTTP/1.0 404 Not Found");
                header('HTTP', true, 500); // 500 internal server error
            }
            ?>
        </table>
        <?php } ?>
        <?php if ($enableGetData === true) { ?>
            <table border="1" cellpadding="5" cellspacing="2">
                <tr>
                    <th colspan="7">Data Attendance</th>
                </tr>
                <tr>
                    <th>UID</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>State</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Type</th>
                </tr>
                <?php
                    $attendance = $zk->getAttendance();
                    if (count($attendance) > 0) {
                        $attendance = array_reverse($attendance, true);
                        sleep(1);
                        foreach ($attendance as $attItem) {
//=======================================================================
							$idm=$attItem['uid'];
							$ide=$attItem['id'];
							$fecha=$attItem['timestamp'];
							$type=ZK\Util::getAttType($attItem['type']);
							$nombre=isset($users[$attItem['id']]) ? $users[$attItem['id']]['name'] : $attItem['id'];
							$fechaf=date("d/m/Y", strtotime($attItem['timestamp']));
							$fecharef=date("Ymd", strtotime($attItem['timestamp']));
							$horaf=date("H:i:s", strtotime($attItem['timestamp']));
							
							$sql="select count(*)as c,ifnull((select emp_celular from tbl_bio_empleado where emp_codigo=".$ide.
							" and dispositivo_codigo=".$dispo_id."),'')as cel from tbl_bio_marcaje where dispositivo_codigo=".$dispo_id." and marcaje_id=".$idm;
							//echo $sql;
							mysqli_set_charset($conexion,"utf8");
							$result1=mysqli_query($conexion,$sql);
							while ($row = mysqli_fetch_assoc($result1)) 
							{
								$c=$row["c"];
								$celu=$row["cel"];
							}
//========================================================================
                            ?>
                            <tr>
                                <td><?php echo($attItem['uid']); ?></td>
                                <td><?php echo($attItem['id']); ?></td>
                                <td><?php echo(isset($users[$attItem['id']]) ? $users[$attItem['id']]['name'] : $attItem['id']); ?></td>
                                <td><?php echo(ZK\Util::getAttState($attItem['state'])); ?></td>
                                <td><?php echo(date("d-m-Y", strtotime($attItem['timestamp']))); ?></td>
                                <td><?php echo(date("H:i:s", strtotime($attItem['timestamp']))); ?></td>
                                <td><?php echo(ZK\Util::getAttType($attItem['type'])); ?></td>
                            </tr>
                            <?php
//========================================================================
					if($c==0)
					{
						$f=strpos($type,"out");
						$eosi=($f)?2:1;
						$eosn=($f)?"Salida":"Entrada";
						
						$sql="insert into tbl_bio_marcaje(dispositivo_codigo,marcaje_id,emp_codigo,marcaje_fecha,marcaje_tipo,eos_id,marcaje_estado,marcaje_fecharef) values(".
						$dispo_id.",'".$idm."',".$ide.",'".$fecha."','".$type."',".$eosi.",'ACTIVO','".$fecharef."')";
						//echo $sql;
						$resultado=mysqli_query($conexion,$sql);
						$cont_mar++;
						
						//echo "Celu ".$celu;
						
						if($celu!="")
						{
							$mensage="Aviso: Hola ".$nombre." Usted marcó su ".$eosn." A las ".$horaf." del ".$fechaf;
							$para=$celu;
							$api=$client->sendChatMessage($para,$mensage);
							$salida=$salida." ".$mensage." ".$para."<br>";
						}
					}
//========================================================================							
                        }
						$sql="insert into tbl_bio_log(log_fecha,dispositivo_codigo,log_registro1,log_registro2) values(now(),".$dispo_id.",".$cont_emp.",".$cont_mar.")";
						$resultado=mysqli_query($conexion,$sql);
                    }
                ?>
            </table>
        <?php } ?>
        <?php
        $zk->enableDevice();
        $zk->disconnect();
    }
?>
</body>
</html>