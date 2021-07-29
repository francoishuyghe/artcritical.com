@extends('layouts.app')
@section('content')

<?php
$tags = get_tags();
$tags = App\array_split($tags, 5);
isset($_GET['tag_group']) ? $tag_group = $_GET['tag_group'] : $tag_group = 0;
isset($_GET['tab']) ? $tab = $_GET['tab'] : $tab = 'bysubject';
?>
	<script>
	var prev_id = '<?= $tab ?>';
	</script>
	<div id="main">
		<span class="futura">Browse: </span>
		<span class="futura <?= $tab == 'bysubject' ? 'selected' : ''?>" style="margin-left:20px" id="bysubject_tab"><a href="#" class="tab-link" data-tab="bysubject">By Subject</a></span>
		<span class="futura <?= $tab == 'byauthor' ? 'selected' : ''?>" style="margin-left:20px" id="byauthor_tab"><a href="#" class="tab-link" data-tab="byauthor">By Author</a></span>
		<span class="futura <?= $tab == 'bymonth' ? 'selected' : ''?>" style="margin-left:20px" id="bymonth_tab"><a href="#" class="tab-link" data-tab="bymonth">By Month</a></span>
		<span class="futura <?= $tab == 'cover_archive' ? 'selected' : ''?>" style="margin-left:20px" id="cover_archive_tab"><a href="#" class="tab-link" data-tab="cover_archive">Cover Archive</a></span>
		<hr style="background-color:#000">
		<div id="bysubject" <?= $tab == 'bysubject' ? '' : 'style="display:none"'?>>
			<div id="tag_menu">
				<?php
				$count = 0;
				foreach($tags as $group){
					$count == $tag_group ? $class = "class=\"selected\"" : $class = "";
					
					strpos($group[0]->name, ',') ? $group1 = implode(" ",array_reverse(explode(",",$group[0]->name))) : $group1 = $group[0]->name;
					
					strpos($group[count($group) - 1]->name, ',') ? $group2 = implode(" ",array_reverse(explode(",",$group[count($group) - 1]->name))) : $group2 = $group[count($group) - 1]->name;
					
					echo "<a href=\"?tag_group=".$count."\" $class>".$group1." to ".$group2."</a>";
					$count++;
				}
				?>
			</div>
			<div id="tag_list">
				<?php
				foreach($tags[$tag_group] as $tag){
					
					strpos($tag->name, '|') ? $tagname = implode(" ",array_reverse(explode("|",$tag->name))) : $tagname = $tag->name;
					
					echo "<div class=\"tag_link\"><a href=\"javascript:tag_expand('".$tag->slug."', '".$tagname."')\">".$tagname."</a><span id=\"".$tag->slug."_loading\" class=\"loading\" style=\"display:none;\"><img src=\"".get_bloginfo('stylesheet_directory'). "/images/ajax-loader.gif\"></span></div>";
					echo "<div id=\"".$tag->slug."_results\" style=\"display:none\">&nbsp;</div>";
				}
				?>
			</div>
		</div>
		<div id="byauthor" class="archive_list" <?= $tab == 'byauthor' ? '' : 'style="display:none"'?>>
			<?php
			$ud = get_users();
			foreach($ud as $userdata){
				if($userdata->last_name !== ""){
					if(in_array('administrator', $userdata->roles) || in_array('regular', $userdata->roles)){
						$editors .= "<li><a href=". App::get_myauthor_link($userdata->user_nicename)."> ".$userdata->first_name." ".$userdata->last_name."</a></li>";
					}
					if(in_array('guest', $userdata->roles)){
						$regulars .= "<li><a href=". App::get_myauthor_link($userdata->user_nicename)."> ".$userdata->first_name." ".$userdata->last_name."</a></li>";
					}
					if(in_array('past', $userdata->roles)){
						$past .= "<li><a href=". App::get_myauthor_link($userdata->user_nicename)."> ".$userdata->first_name." ".$userdata->last_name."</a></li>";
					}
				}
			}
			?>
			<div class="author_row">
				<strong>Regulars</strong>
				{!! $editors !!}
			</div>
			<div class="author_row">
				<strong>Guests</strong>
				{!! $regulars !!}
			</div>
			<div class="author_row">
				<strong>Past</strong>
				{!! $past !!}
			</div>
			<br style="clear:both">
		</div>
		<div id="bymonth" class="archive_list" <?= $tab == 'bymonth' ? '' : 'style="display:none"'?>>
			<?php wp_get_archives('type=monthly'); ?>
		</div>
		<div id="cover_archive" class="archive_list" <?= $tab == 'cover_archive' ? '' : 'style="display:none"'?>>
			<div id="bycover" class="cover_list">
				<table>

				<?php
				$count = 0;
				$args = array(
					'post_type' => 'cover',
					'post_status'  => 'publish',
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => 50
				);	
				$covers = new WP_Query($args);
				if ($covers->have_posts()) : while ($covers->have_posts()) : $covers->the_post();
					if ($count == 0) {
						echo "<tr>";
					}
					if ($count == 5) {
						echo "</tr>";
						$count = 0;
					}
					$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
					?>
					<td class="cover">
						<div id="thumb"><a class="thickbox no_icon" title="<?php the_excerpt();?>" href="<?php echo $img[0] ?>"><?php the_post_thumbnail('thumbnail');?></a></div>
						<h2><?php the_title()?></h2>
					</td>
					<?php
					$count++;
				endwhile;
				endif;
				?>
				</table>
			</div>
		</div>
	</div>

	@include('partials.sidebar-browse')
@endsection