<?php
class Controller_Admin_Images extends Controller_Admin{

	public function action_index()
	{
		$data['images'] = Model_Image::find('all');
		$this->template->title = "Images";
		$this->template->content = View::forge('admin\images/index', $data);

	}

	public function action_view($id = null)
	{
		$data['image'] = Model_Image::find($id);

		$this->template->title = "Image";
		$this->template->content = View::forge('admin\images/view', $data);

	}

	public function action_create()
	{
		$view = View::forge('admin\images/create');
		if (Input::method() == 'POST')
		{
			$val = Model_Image::validate('create');

			if ($val->run())
			{
				$image = Model_Image::forge(array(
					'plant_id' => Input::post('plant_id'),
					'url' => Input::post('url'),
				));


				$config = array(
				    'path' => DOCROOT.'herbals_photos/'. $image->plant_id,
				    'randomize' => false,
				    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png')
				    // 'max_size'=> 1024 * 1024,
				);


				// while(Upload::get_files()){

				// process the uploaded files in $_FILES
				Upload::process($config);

				// if there are any valid files
					if (Upload::is_valid())
					{
					    // save them according to the config
					    Upload::save();
						$value = Upload::get_files();
						// Upload::save($config['path'], array_keys($value));

					    $upload_count = 0;//for upload content
					    $i = 0;//index for POST method index used for multiple file upload

					    foreach ($value as $files) {
					    	$image->url = $value[$upload_count]['saved_as'];//incremental upload using the POST method index
					    	$date = new DateTime();
					    	DB::Query("INSERT INTO `images`(`plant_id`,`url`,`created_at`, `updated_at`) VALUES ('".$image->plant_id."','".$value[$upload_count]['name']."', '".$date->getTimestamp()."', '".$date->getTimestamp()."')")->execute();
					    	// $image->save();

							$upload_count++;

			    			// Read the contents of a directory
			    			try
							{
							    $dir = File::create_dir(DOCROOT.'herbals_photos', $image->plant_id, 0755, null);
							}
							catch(\FileAccessException $e)
							{
							    // Operation failed
							}
							try
							{
							    $dir = File::create_dir(DOCROOT.'herbals_photos/'.$image->plant_id,'/thumbs', 0755, null);
							}
							catch(\FileAccessException $e)
							{
							    // Operation failed
							}

							Image::load('herbals_photos/'.$image->plant_id.'/'.$image->url)
								->crop_resize(128, 128)
							    ->save('herbals_photos/'.$image->plant_id.'/thumbs/'.$image->url);
						}

						if($image)
						{
							Session::set_flash('success', e('Added '.$upload_count.' image(s)'));

							Response::redirect('admin/images');
						}
						else
						{
							Session::set_flash('error', e('Opps!, Something went wrong!'));
						}

						/*if ($image and $image->save())
						{
							Session::set_flash('success', e('Added image #'.$image->id.'.'));

							Response::redirect('admin/images');
						}

						else
						{
							Session::set_flash('error', e('Could not save image.'));
						}*/
					
					}//end if (Upload::is_valid())

			  	// }//end while

			}//if ($val->run())


			else
			{
				Session::set_flash('error', $val->error());
			}
		}


		$view->set_global('plant', Arr::assoc_to_keyval(Model_Plant::find('all'), 'id', 'name'));

		$this->template->title = "Images";
		$this->template->content = $view;

	}

	public function action_edit($id = null)
	{
		$view = View::forge('admin\images/edit');
		$image = Model_Image::find($id);
		$val = Model_Image::validate('edit');

		if ($val->run())
		{
			$image->plant_id = Input::post('plant_id');
			$image->url = Input::post('url');

			if ($image->save())
			{
				Session::set_flash('success', e('Updated image #' . $id));

				Response::redirect('admin/images');
			}

			else
			{
				Session::set_flash('error', e('Could not update image #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$image->plant_id = $val->validated('plant_id');
				$image->url = $val->validated('url');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('image', $image, false);
		}

		$view->set_global('plant', Arr::assoc_to_keyval(Model_Plant::find('all'), 'id', 'name'));
		$this->template->title = "Images";
		$this->template->content = $view;

	}

	public function action_delete($id = null)
	{
		if ($image = Model_Image::find($id))
		{
			$image->delete();

			$query = DB::query("SELECT `id` FROM `images` ORDER BY `id` DESC LIMIT 1")->execute()->as_array();
			$query2 = DB::query("ALTER TABLE `images` AUTO_INCREMENT = ".$query[0]["id"])->execute();

			Session::set_flash('success', e('Deleted image #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete image #'.$id));
		}

		Response::redirect('admin/images');

	}


}