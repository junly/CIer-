<?php
/**
 * CI捐款 
 * @param 用户 $user
 * @param 支援款 $money
 * @param 支援时间 $time
 */
function cier_donate($user = '',$money = NULL,$time = NULL)
{
	$user = mb_substr($user,0,mb_strlen($user)-1).'*';
	$money = 'RMB'.nbs(2).number_format($money, 2, '.','').'元';

	return "<tr>
            <td>{$user}</td>
            <td>{$time}</td>
            <td>{$money}</td>
    		</tr>";
		
}
