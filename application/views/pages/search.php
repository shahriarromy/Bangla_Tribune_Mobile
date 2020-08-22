<?php $this->load->view('includes/header'); 
echo '<pre>';
print_r($details);
echo '</pre>';
?>
<div class="categoryContainer country">
    <div class="article LeftalignedImg categoryPage">
        <div class="inner">
            <?php
            if(is_array($details['data'])){
            foreach ($details['data'] as $value) {
                ?>
                <div class="left_item clearfix">
                    <div class="leftImg_title">
                        <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                    </div>
                    <div class="right_content">
                        <div class="title_holder">
                            <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                                <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                                <span class="title"><?php echo $value['title']; ?></span>
                            </a>
                        </div>
                        <div class="summery">
                            <a href="<?php echo url_format_fnc($value['web_url']); ?>"><?php echo limit_words($value['excerpt'], 15); ?><span class="excerpt_more" title="বিস্তারিত"><span>বিস্তারিত</span></span></a>
                        </div>
                    </div>
                </div>
                <?php
            }
            } else {
                echo 'কোন তথ্য পাওয়া যায়নি';
            }
            ?>
        </div>
        <div class="pagination">
          

            <a style="<?php if(!$this->input->get('page')) echo 'display:none'; ?>" href="<?php echo base_url(); ?>country?page=<?php echo $back; ?>" class="next_page"><span>&lt;&lt;</span></a>
           
            
            <a style="" href="<?php echo base_url('country?page='.$limit); ?>" class="next_page"><span>&gt;&gt;</span></a></div>
    </div>
</div>
<?php
$this->load->view('includes/footer');
