<?
use app\component\DXConst;

function get_module($agenda, $module_id)
{
	foreach ($agenda as $module)
	{
		if (intval($module['id']) == intval($module_id))
		{
			return $module;
		}
	}

	return null;
}

function get_child_module($module, $sub_module_id)
{
	foreach ($module['child'] as $child_module)
	{
		if (intval($child_module['id']) == intval($sub_module_id))
		{
			return $child_module;
		}
	}

	return null;
}

$user_map = [];

function get_user($user_id)
{
    if (isset($user_map[$user_id]))
    {
        return $user_map[$user_id];
    }

    $user_id = intval($user_id);
    $user = sql(' select * from {{%user}} where id = '. $user_id .' ')->queryOne();
    if ($user)
    {
        $user_map[$user_id] = $user;
    }

    return $user;
}

$role_map = [
    1 => '主持人',
    2 => '参会者',
    3 => '助理',
    4 => '评论员',
    5 => '记录员'
];

foreach ($process_list as $process)
{
	$type = intval($process['type']);
	$user_id = intval($process['user_id']);
	$created = intval($process['created']);
	$user = get_user($user_id);
	$data = json_decode($process['data'], true);

	$content = '';
    switch ($type)
    {
        case DXConst::PROCESS_CHANGE_MODULE :
        {
    		$from_module_id = @intval($data['from_module_id']);
            $to_module_id = @intval($data['to_module_id']);
            $child_module_id = @intval($data['sub_module_id']);

            $from_module = get_module($agenda, $from_module_id);
            $from_module_name = @$from_module['name'];
            $to_module = get_module($agenda, $to_module_id);
            $to_module_name = @$to_module['name'];
            if ($child_module_id != 0)
            {
                $child_module = get_child_module($to_module, $child_module_id);
                $child_module_name = @$child_module['name'];
                $content = "从[$from_module_name]模块切换到[$to_module_name]模块的[$child_module_name]子模块";
            }
            else
            {
                $content = "从[$from_module_name]模块切换到[$to_module_name]模块";
            }
    	} break;

        case DXConst::PROCESS_CHANGE_SPEAKER :
        {
            $speaker_id = intval(@$data['user_id']); 
            $target_user = get_user($speaker_id);
            $target_user_name = @$target_user['name'];
            $content = "切换到[$target_user_name]发言";
        } break;

        case DXConst::PROCESS_CANCEL_SPEAKER :
        {
            $speaker_id = intval(@$data['user_id']); 
            $target_user = get_user($speaker_id);
            $target_user_name = @$target_user['name'];
            $content = "结束[$target_user_name]发言";
        } break;

        case DXConst::PROCESS_APPLY_SPEAK_CHANGE :
        {
            $apply_user_id = intval(@$data['user_id']);  
            $user_list = @$data['user_list'];
            $apply_user = get_user($apply_user_id);
            $apply_user_name = @$apply_user['name'];
            $content = "[$apply_user_name]申请发言";
        } break;

        case DXConst::PROCESS_CHOOSE_APPLY_SPEAKER :
        {
            $chosen_user_id = intval(@$data['user_id']);  
            $user_list = @$data['user_list'];
            $chosen_user = get_user($chosen_user_id);
            $chosen_user_name = @$chosen_user['name'];
            $content = "选择[$chosen_user_name]发言";            
        } break;

        case DXConst::PROCESS_QUIT_SUB_MODULE :
        {
            $module_id = @intval($data['module_id']);
            $child_module_id = @intval($data['sub_module_id']);

            $module = get_module($agenda, $module_id);
            if (!$module)
            {
                continue;
            }

            $module_name = @$module[@"name"];
            $child_module = get_child_module($module, $child_module_id);
            $child_module_name = @$child_module['name'];
            $content = "退出[$module_name]模块的[$child_module_name]子模块";           
        } break;

        case DXConst::PROCESS_TIME_ALERT :
        {
            $speaker_id = intval(@$data['user_id']); 
            $target_user = get_user($speaker_id);
            $target_user_name = @$target_user['name'];
            $content = "提醒[$target_user_name]注意时间";
        }
    }

?>
	<div id="process-<?= $process['id'] ?>" class="process" data-id="<?= $process['id'] ?>">
		<div class="time"><?= timeFormat($created) ?>:<?= $process['type'] ?></div>
		<div class="user"><?= @$role_map[intval($user['type'])] ?><?= @$user['name'] ?></div>
		<div class="content"><?= $content ?></div>
	</div>
<?
}
?>