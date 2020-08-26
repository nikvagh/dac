<?php

	class Page_Model extends CI_Model {
		
		function Page_Model()
		{
			//parent::CI_Model();
			parent::__construct();
			
			$this->table = 'page';
			
			$this->column_headers = array(
										  "Page Title"		=>	"",
										 // "Page Slug"		=>	"",
										  "Page Order"		=>	"",
										  "Page Publish"	=>	"",
										  );
		
			$this->SortDirection 	= array('1'		=> 'Asc',
											'2'		=> 'Desc',
											);
		}
		
		function get_page($data)
		{
			$this->db->select('*');
			
			if ( is_array($data) )
			{
				foreach ($data as $key => $value)
				{
					$this->db->where($key, $value);
				}
			}
			else
			{
				$this->db->where('uri', $data);
			}
			
			$query = $this->db->get($this->table, 1);
			
			if ( $query->num_rows() == 1 )
			{
				return $query->row_array();
			}
			else
			{
				return false;
			}
		}
		
		function get_list_count()
		{
			$request = getRequests();
			$this->db->select('*');
			$this->db->order_by("page_id", "asc"); 
			
			$query = $this->db->get($this->table);
			
			return $query->num_rows() ;
		}

		function list_pages($num='', $offset='')
		{
			$this->db->select('*');
			$this->db->order_by("page_id", "asc"); 
			$this->db->limit($num,$offset);
			
			$query = $this->db->get($this->table);

			$pages = array();
			
			if ( $query->num_rows() > 0 )
			{
				$pages = $query->result_array();
			}
			
			return $pages;
		}

		function getPage($page_id)
		{
			$this->db->select('*');
			$this->db->where('page_id', $page_id); 
			
			$query = $this->db->get($this->table);
			
			if ( $query->num_rows() == 1 )
			{
				return $query->row_array();
			}
			else
			{
				return false;
			}
		}

		function getMaxPageOrder()
		{
			$sql = "select max(page_order) as max_order from ".$this->table;
			
			$rs = $this->db->query($sql);
			
			if ( $rs->num_rows() == 1 )
			{
				$result = $rs->row_array();
				return $result['max_order'];
			}
			else
			{
				return false;
			}
		}

		function insert()
		{
                    $slug = url_title($this->input->post('page_menutitle'));
                    $max_order = $this->getMaxPageOrder();
                    $page_order = $max_order+1;

                    $pos = array();

                    if($this->input->post('page_position'))
                            $pos = $this->input->post('page_position');

                    $data = array(
                                            'page_title' 			=>	$this->input->post('page_title'),
                                            'page_slug' 			=>	$slug,
                                            'page_type'				=>	$this->input->post('page_type'),
                                            'page_url'				=>	$this->input->post('page_url'),
                                            'page_parent_id' 		=>	$this->input->post('page_parent_id'),
                                            'page_content' 			=>	$this->input->post('page_content'),
                                            'page_menutitle' 		=>	$this->input->post('page_menutitle'),
                                            'page_browsertitle' 	=>	$this->input->post('page_browsertitle'),
                                            'page_metatitle' 		=>	$this->input->post('page_metatitle'),
                                            'page_metakeyword' 		=>	$this->input->post('page_metakeyword'),
                                            'page_metadesc' 		=>	$this->input->post('page_metadesc'),
                                            'page_order' 			=>	$page_order,
                                            'page_publish' 			=>	$this->input->post('page_publish'),
                                            'page_position'			=>	implode(',', $pos),
                                            );

                    $this->db->insert($this->table, $data);
                    return $this->db->insert_id();
		}

		function update()
		{
			$slug = url_title($this->input->post('page_menutitle'));
//			$querypage = $this->db->get('page');
//			$totalpage = $querypage->num_rows;
//			$page_order = $totalpage+1;

			$pos = array();
			if($this->input->post('page_position'))
				$pos = $this->input->post('page_position');

			$data = array(
						'page_title' 			=>	$this->input->post('page_title'),
						'page_slug' 			=>	$slug,
						'page_type'				=>	$this->input->post('page_type'),
						'page_url'				=>	$this->input->post('page_url'),
						'page_parent_id' 		=>	$this->input->post('page_parent_id'),
						'page_content' 			=>	$this->input->post('page_content'),
						'page_menutitle' 		=>	$this->input->post('page_menutitle'),
						'page_browsertitle' 	=>	$this->input->post('page_browsertitle'),
						'page_metatitle' 		=>	$this->input->post('page_metatitle'),
						'page_metakeyword' 		=>	$this->input->post('page_metakeyword'),
						'page_metadesc' 		=>	$this->input->post('page_metadesc'),
//						'page_order' 			=>	$page_order,
						'page_publish' 			=>	$this->input->post('page_publish'),
						'page_position'			=>	implode(',', $pos),
						);
						
			$this->db->where('page_id', $this->input->post('page_id'));
			if($this->db->update($this->table, $data))
				return true;
			else
				return false;
		}

		function deleteselected()
		{
			$this->db->where_in('page_id', $this->input->post('p_list'));
	
			if($query = $this->db->delete($this->table)) 
				return true;
			else
				return false;
		}

		function delete()
		{
			$this->db->where('page_id', $this->input->post('pageid'));
	
			if($query = $this->db->delete($this->table)) 
				return true;
			else
				return false;
		}

		function changePublishStatus()
		{
			$this->db->set('page_publish', $this->input->post('publish'));
			$this->db->where('page_id', $this->input->post('pageid'));
			$this->db->update($this->table);
			
			return true;
		}

		function changeOrder()
		{
			$rsPage = $this->getPage($this->input->post('pageid'));
			
			if($this->input->post('move') == 'Up')
			{
				$this->db->select('*');
				$this->db->where('page_order < ', $rsPage['page_order']); 
				$this->db->where('page_id != ', $this->input->post('pageid'));
				$this->db->where('page_parent_id = ', $this->input->post('parentid')); 
				$this->db->order_by("page_order", "desc");
				
				$query = $this->db->get($this->table);
				
				if ( $query->num_rows() > 0 )
				{
					$row = $query->row_array();
				}
			}
			else
			{
				$this->db->select('*');
				$this->db->where('page_order > ', $rsPage['page_order']); 
				$this->db->where('page_id != ', $this->input->post('pageid')); 
				$this->db->where('page_parent_id = ', $this->input->post('parentid')); 
				$this->db->order_by("page_order", "asc");
				
				$query = $this->db->get($this->table);
				
				if ( $query->num_rows() > 0 )
				{
					$row = $query->row_array();
				}
			}
			
			$this->db->set('page_order', $row['page_order']);
			$this->db->where('page_id', $this->input->post('pageid'));
			$this->db->update($this->table);
			
			$this->db->set('page_order', $rsPage['page_order']);
			$this->db->where('page_id', $row['page_id']);
			$this->db->update($this->table);

			return true;
		}

		function getParentDropdown($parent_id=0, $level=0)
		{
			$this->db->select('page_id, page_title, page_parent_id');
			$this->db->where('page_parent_id', $parent_id); 
			$this->db->order_by("page_order", "asc");

			$query = $this->db->get($this->table);

			$rsPage = $query->result_array();

			if($rsPage)
			{	
				$level++;
				foreach($rsPage as $key=>$val)
				{
					$rsSubPage = $this->getParentDropdown($val['page_id'],$level);
					
					if($rsSubPage)
					{	
						$rsPage[$key]['child'] = $rsSubPage;
					}
				}
			}

			return $rsPage;
		}

		function fillParentDropdown($parent_array, $level=0, $selected)
		{
			$con_str='';

//			if($level < 1)
			{
			for($m=0;$m<$level;$m++)
			{
				$con_str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			$level++;

			for($i=0;$i<count($parent_array);$i++)
			{
				if($parent_array[$i]['page_id'] == $selected)
					echo "<option value=".$parent_array[$i]['page_id'].' selected="selected">'.$con_str.'|--&nbsp;'.$parent_array[$i]['page_title']."</option>";
				else
					echo "<option value=".$parent_array[$i]['page_id'].">".$con_str.'|--&nbsp;'.$parent_array[$i]['page_title']."</option>";

				if($parent_array[$i]['child'])
				{
					$this->fillParentDropdown($parent_array[$i]['child'], $level, $selected);
				}
			}
			}
		}

		function getPageList($parent_id=0, $level=0)
		{
			$this->db->select('page_id, page_title, page_parent_id');
			$this->db->where('page_parent_id', $parent_id); 
//			$this->db->order_by("page_id", "asc");
			
			$query = $this->db->get($this->table);

			$rsPage = $query->result_array();

			if($rsPage)
			{	
				$level++;
				foreach($rsPage as $key=>$val)
				{
					$rsSubPage = $this->getPageList($val['page_id'],$level);
					
					if($rsSubPage)
					{	
						$rsPage[$key]['child'] = $rsSubPage;
					}
				}
			}

			return $rsPage;
		}

		function ViewAll($parent_id=0, $level=0)
		{
			$this->db->select('*');
			$this->db->where('page_parent_id', $parent_id); 
			$this->db->order_by("page_order", "asc");
			
			$query = $this->db->get($this->table);

			$rsPage = $query->result_array();

			if($rsPage)
			{	
				$level++;
				foreach($rsPage as $key=>$val)
				{
					$rsSubPage = $this->ViewAll($val['page_id']);
					
					if($rsSubPage)
					{	
						$rsPage[$key]['child'] = $rsSubPage;
						$rsPage[$key]['count'] = count($rsSubPage);
					}
				}
			}
			return $rsPage;
		}

		function setPageList($parent_array, $level=0)
		{
			$con_str='';

			for($m=0;$m<$level;$m++)
			{
				$con_str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			$level++;

			for($i=0;$i<count($parent_array);$i++)
			{
				$arrPage['id'] = $parent_array[$i]['page_id'];
				$arrPage['title'] = $con_str.'|--&nbsp;'.$parent_array[$i]['page_title'];
				
				//echo "<option value=".$parent_array[$i]['page_id'].">".$con_str.'|--&nbsp;'.$parent_array[$i]['page_title']."</option>";

				if($parent_array[$i]['child'])
				{
					$this->setPageList($parent_array[$i]['child'], $level);
				}
			}
			print"<pre>"; print_r($arrPage); print "</pre>";
		}

		function getTreeView($parent_array, $level = 0, $nodelevel = 0, $nodeid = 0)
		{
			$nodeid++;

			if($level==0)
				echo '<ul id="navlist_'.$nodeid.'" class="nav-list-ul" style="margin:1px;">';
			else
				echo '<ul id="navlist_'.$nodeid.'" class="nav-list-ul">';

			$nodelevel++;
			
			$str = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $nodelevel);
			
			for($i=0;$i<count($parent_array);$i++)
			{
				if($nodelevel == 1)
				{
					echo '<li id="page_'.$parent_array[$i]['page_id'].'" class="nav-list-li"><div class="nav-item-root">'.$str.'<img src="'.base_url().'images/admin/arrow.png" alt="move" class="handle" />'.$parent_array[$i]['page_title'].'</div>';
				}
				else
				{
					echo '<li id="page_'.$parent_array[$i]['page_id'].'" class="nav-list-li"><div class="nav-item">'.$str.'<img src="'.base_url().'images/admin/arrow.png" alt="move" class="handle" />'.$parent_array[$i]['page_title'].'</div>';
				}
				if($parent_array[$i]['child'])
				{	$level++;
					$this->getTreeView($parent_array[$i]['child'], $level, $nodelevel, $parent_array[$i]['page_id']);
				}
				echo '</li>';
			}
			echo'</ul>';
		}

	}


?>