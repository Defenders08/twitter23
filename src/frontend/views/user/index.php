<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
$this->title = "Профиль";
?>
<div class="page_body">
	<div class="page_content">
		<div class="page_content_header" style="background: url(/<?=Html::encode($user->bgimage)?>)">
			<div class="page_content_header_ava">
				<img src="/<?=Html::encode($user->img)?>">
			</div>
		</div>
		<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
			<div class="newpost_pr">
				<div class="newpost_textarea">
					<?=$form->field($model, 'text')->textarea(['rows' => 10, 'placeholder' => "Что нового?"])?>
				</div>
				<div class="newpost_bts">
					<div class="newpost_tw">
						<label for="postform-img" class="btn" id="img-label">Прикрепить <a href="#"></a></label>
						<a href="#"><?=$form->field($model, 'img')->fileInput()?></a>
					</div>
					<div class="newpost_bt">
						<button>Опубликовать</button>
					</div>
				</div>
			</div>
		<?php ActiveForm::end() ?>
		<div class="posts">
			<?php for ($i = 0; $i < count($posts); $i++): ?>
				<?php if (empty($posts[$i]['replies']) && $posts[$i]['replyid'] == 0): ?>
					<div class="post">
						<div class="post_ava">
							<img src="/<?=Html::encode($user->img)?>">
						</div>
						<div class="post_content">
							<div class="post_content_name">
								<?=Html::encode($user->name)?>
								<a href="/<?=Html::encode($user->username)?>">
									@<?=Html::encode($user->username)?>
								</a>
							</div>
							<div class="post_content_data">
								<?=Html::encode($posts[$i]['date'])?>
							</div>
							<div class="post_content_text">
								<?=$posts[$i]['text']?>
							</div>
							<?php if ($posts[$i]['img']): ?>
								<div class="post_content_img">
									<img src="<?=Html::encode($posts[$i]['img'])?>">
								</div>
							<?php endif; ?>
							<div class="post_content_nav">
								<div class="post_content_nav_left">
									<a class="delete" data-id="<?=Html::encode($posts[$i]['id'])?>">
										Удалить
									</a>
									<a class="edit" href="/edit?id=<?=Html::encode($posts[$i]['id'])?>">
										Редактировать
									</a> 
									<a href="/me?mode=reply&replypost=<?=Html::encode($posts[$i]['id'])?>">
										Ответить (0)
									</a>
								</div>
								<div class="post_content_nav_right">
									<a class="like" data-id="<?=Html::encode($posts[$i]['id'])?>">
										Нравится (<?=Html::encode($posts[$i]['likes'])?>)
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php elseif (!empty($posts[$i]['replies'])): ?>	
						<div class="post_replay">
							<div class="post_replay_top">
								<div class="post_ava">
									<img src="/<?=Html::encode($user->img)?>">
								</div>
								<div class="post_content">
									<div class="post_content_name">
										<?=Html::encode($user->name)?>
										<a href="/<?=Html::encode($user->username)?>">
											@<?=Html::encode($user->username)?>
										</a>
									</div>
									<div class="post_content_data">
										<?=Html::encode($posts[$i]['date'])?>
									</div>
									<div class="post_content_text">
										<?=$posts[$i]['text']?>
									</div>
									<?php if ($posts[$i]['img']): ?>
										<div class="post_content_img">
											<img src="<?=Html::encode($posts[$i]['img'])?>">
										</div>
									<?php endif; ?>
									<div class="post_content_nav">
										<div class="post_content_nav_left">
											<a class="delete" data-id="<?=Html::encode($posts[$i]['id'])?>">Удалить</a> 
											<a class="edit" href="/edit?id=<?=Html::encode($posts[$i]['id'])?>">
												Редактировать
											</a> 
											<a href="/me?mode=reply&replyid=<?=Html::encode($posts[$i]['userid'])?>&replypost=<?=Html::encode($posts[$i]['id'])?>">
												Ответить (<?=count($posts[$i]['replies'])?>)
											</a>
										</div>
										<div class="post_content_nav_right">
											<a class="like" data-id="<?=Html::encode($posts[$i]['id'])?>">
												Нравится (<?=Html::encode($posts[$i]['likes'])?>)
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php for ($j = 0; $j < count($posts[$i]['replies']); $j++): ?>
								<div class="post_replay_bl"></div>
									<div class="post_replay_bottom">
										<div class="post_ava">
											<img src="/<?=Html::encode($repliers[$i][$j]->img)?>">
										</div>
										<div class="post_content">
											<div class="post_content_name">
												<?=Html::encode($repliers[$i][$j]->name)?>
												<a href="/<?=Html::encode($repliers[$i][$j]->username)?>">
													@<?=Html::encode($repliers[$i][$j]->username)?>
												</a>
											</div>
											<div class="post_content_data">
												<?=Html::encode($posts[$i]['replies'][$j]->date)?>
											</div>
											<div class="post_content_text">
												<a href="#">@<?=Html::encode($user->username)?></a>
												<?=$posts[$i]['replies'][$j]->text?>
											</div>
											<?php if ($posts[$i]['replies'][$j]->img != null): ?>
												<div class="post_content_img">
													<img src="<?=Html::encode($posts[$i]['replies'][$j]->img)?>">
												</div>
											<?php endif; ?>
											<div class="post_content_nav">
												<div class="post_content_nav_left">
													<?php if ($posts[$i]['replies'][$j]->userid == $user->id): ?>
														<a class="delete" data-id="<?=Html::encode($posts[$i]['replies'][$j]->id)?>">
															Удалить
														</a> 
														<a href="/edit?id=<?=Html::encode($posts[$i]['replies'][$j]->id)?>" class="edit">
															Редактировать
														</a>
													<?php endif; ?>
													<a href="#">Ответить</a>
												</div>
												<div class="post_content_nav_right">
													<a class="like" data-id=<?=Html::encode($posts[$i]['replies'][$j]->id)?>>
														Нравится (<?=$posts[$i]['replies'][$j]->likes?>)
													</a>
												</div>
											</div>
										</div>
									</div>
								<?php endfor; ?>
							</div>
						<?php endif; ?>
					<?php endfor; ?>
				</div>
			</div>
			<div class="page_menu">
				<div class="page_menu_sticky">
					<div class="profile_names">
						<div class="profile_names_left">
							<img src="/<?=Html::encode($user->img)?>" class="profile_names_ava">
						</div>
						<div class="profile_names_right">
							<div class="profile_names_username">
								<?=Html::encode($user->username)?>
							</div>
							<div class="profile_names_name">
								<?=Html::encode($user->name)?>
							</div>
						</div>
					</div>
					<div class="page_menu_bio">
						<div class="page_menu_bio_str">
							<?php if (strlen($user->about)): ?>
								<span class="page_menu_bio_str_name">О себе</span>
								<?=Html::encode($user->about)?>
							<?php endif; ?>
						</div>
						<div class="page_menu_bio_str">
							<span class="page_menu_bio_str_name">Пол</span>
							<?php if (Html::encode($user->gender) == 'woman'): ?>
								<?=Html::encode('Женский')?>
							<?php elseif (Html::encode($user->gender) == 'man'): ?>
								<?=Html::encode('Мужской')?>
							<?php else: ?>
								<?=Html::encode('Другой')?>
							<?php endif; ?>
						</div>
						<div class="page_menu_bio_str">
							<?php if (strlen($user->city)): ?>
								<span class="page_menu_bio_str_name">Город</span>
								<?=Html::encode($user->city)?>
							<?php endif; ?>
						</div>
						<div class="page_menu_bio_str">
							<?php if (strlen($user->site)): ?>
								<span class="page_menu_bio_str_name">Сайт</span>
								<a href="<?=Html::encode($user->site)?>">
									<?=Html::encode($user->site)?>
								</a>
							<?php endif; ?>
						</div>
						<div class="page_menu_bio_str">
							<?php if (strlen($user->telegram)): ?>
								<span class="page_menu_bio_str_name">Telegram</span>
								<a href="https://t.me/<?=Html::encode($user->telegram)?>">
									<?=Html::encode($user->telegram)?>
								</a>
							<?php endif; ?>
						</div>
						<div class="page_menu_bio_str">
							<span class="page_menu_bio_str_name">Дата Регистрации</span>
							<?=Html::encode(date("d.m.Y", strtotime($user->regdate)))?>
						</div>
					</div>
					<div class="fl_menu">
						<div class="fl_menu_block">
							<div class="fl_menu_n"><?=Html::encode($subs)?></div>
							<div class="fl_menu_name"><a href="/subscribers">Подписчики</a></div>
						</div>
						<div class="fl_menu_block">
							<div class="fl_menu_n"><?=Html::encode($suber)?></div>
							<div class="fl_menu_name"><a href="/suber?mode=1">Подписки</a></div>
						</div>
						<div class="fl_menu_block">
							<div class="fl_menu_n"><?=Html::encode(count($posts))?></div>
							<div class="fl_menu_name"><a href="/me">Твиты</a></div>
						</div>
					</div>
					<div class="page_menu_nav">
						<a href="/notifications">
							<div class="page_menu_nav_link">Уведомления</div>
						</a>
						<a href="/settings-profile">
							<div class="page_menu_nav_link">Редактировать</div>
						</a>
					</div>
					<div class="page_menu_newpost">
					<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
						<div class="page_menu_newpost_textarea">
							<?=$form->field($model, 'text')->textarea(['rows' => 10, 'placeholder' => "Что нового?"])?>
						</div>
						<div class="page_menu_newpost_bts">
							<div class="page_menu_newpost_tw">
								<label for="postform-img" class="btn" id="img-label">Прикрепить <a href="#"></a></label>
								<a href="#"><?=$form->field($model, 'img')->fileInput()?></a>
								
							</div>
							<div class="page_menu_newpost_bt">
								<button>Опубликовать</button>
							</div>
						</div>
					<?php ActiveForm::end() ?>
						</div>
					</div>
				</div>
</div>
<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>