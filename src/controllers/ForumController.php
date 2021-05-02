<?php
	namespace app\src\controllers;
	use app\src\core\Controller;

	class ForumController extends Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->loadModel('Post');
			$this->loadModel('Subject');
			$this->loadModel('Category');
		}

		public function index()
		{
			$tab = array();
			$categories = $this->Category->GetAll();
			foreach ($categories as $category) {
				$id = intval($category['id'], 10);
				$subjects = $this->Subject->GetByCategory($id, 3);
				array_push($tab, [
					'infos' => $category,
					'content' => $subjects
				]);
			}
			$this->render('forum', 'index', [
				'categories' => $tab
			]);
		}

		public function categorie(string $slug)
		{
			$ctg = $this->Category->GetBySlug($slug);
			if ($ctg === false) {
				(new ErrorController())->Error_404();
			} else {
				$id_ctg = intval($ctg['id'], 10);
				$subjects = $this->Subject->GetByCategory($id_ctg);
				$this->render('forum', 'category', [
					'category' => $ctg,
					'subjects' => $subjects
				]);
			}
		}
		public function sujet(string $ctg_slug, string $sbj_slug)
		{
			$category = $this->Category->GetBySlug($ctg_slug);
			if ($category === false) {
				(new ErrorController())->Error_404();
			} else {
				$ctg_id = intval($category['id'], 10);
				$subject = $this->Subject->GetBySlug($ctg_id, $sbj_slug);
				if ($subject === false) {
					(new ErrorController())->Error_404();
				} else {
					$sbj_id = intval($subject['id'], 10);
					$posts = $this->Post->GetBySubject($sbj_id);
					$this->render('forum', 'subject', [
						'category' => $category,
						'subject' => $subject,
						'posts' => $posts
					]);
				}
			}
		}
		public function interventions()
		{
			$subjects = $this->Subject->GetInterventions($_SESSION['id']);
			$this->render('forum', 'interventions', ['subjects'=>$subjects]);
		}

		/**
		 * Traite les informations nécessaires pour ajouter un sujet
		 *
		 * @param string $ctg_slug
		 */
		public function ajoutSujet(string $ctg_slug) : void
		{
			if (isset($_POST['name']) && isset($_POST['slug'])) {
				$category = $this->Category->GetBySlug($ctg_slug);
				if ($category === false) {
					(new ErrorController())->Error_404();
				} else {
					$ctg = intval($category['id'], 10);
					$name = htmlentities($_POST['name']);
					$slug = htmlentities($_POST['slug']);
					$this->Subject->Add($_SESSION['id'], $ctg, $name, $slug);

					header('location: //'.HOST.'/'.FOLDER_ROOT.'/forum/categorie/'.$ctg_slug);
				}
			}
		}

		/**
		 * Traite les informations nécessaires pour supprimer un sujet
		 *
		 * @param string $ctg_slug
		 */
		public function retireSujet(string $ctg_slug) : void
		{
			if (isset($_POST['subjet'])) {
				$subject = intval($_POST['subject'], 10);
				$this->Subject->Remove();
			}
		}

		/**
		 * Traite les informations nécessaires pour supprimer un post
		 *
		 * @param string $ctg_slug
		 * @param string $sbj_slug
		 */
		public function ajoutPost(string $ctg_slug, string $sbj_slug) : void
		{
			if (isset($_POST['content'])) {
				$category = $this->Category->GetBySlug($ctg_slug);
				if ($category === false) {
					(new ErrorController())->Error_404();
				} else {
					$ctg_id = intval($category['id'], 10);
					$subject = $this->Subject->GetBySlug($ctg_id, $sbj_slug);
					if ($subject === false) {
						(new ErrorController())->Error_404();
					} else {
						$sbj_id = intval($subject['id'], 10);
						$content = $this->toHTML($_POST['content']);
						$this->Post->Add($_SESSION['id'], $sbj_id, $content);

						$last_post = $this->Post->LastPost($_SESSION['id'], $sbj_id);
						$ancre = '#p_' . $last_post['id'];
						header('location: //'.HOST.'/'.FOLDER_ROOT.'/forum/sujet/'.$ctg_slug.'/'.$sbj_slug.$ancre);
					}
				}
			}
		}

		/**
		 * Traite les informations nécessaire pour supprimer un post
		 *
		 * @param string $ctg_slug
		 * @param string $sbj_slug
		 */
		public function retirePost(string $ctg_slug, string $sbj_slug) : void
		{
			if (isset($_POST['post']))
			{
				$post = intval($_POST['post'], 10);
				$this->Post->Remove($post);
			}
		}

		/**
		 * Traduit le BBcode en HTML
		 *
		 * @param string $text
		 * @return string
		 */
		private function toHTML($txt) : string
		{
			$txt = htmlentities($txt);
			$bbcode = array(
				'\[g\](.*?)\[/g\]' => '<span class=\'bold\'>$1</span>',
				'\[i\](.*?)\[/i\]' => '<span class=\'italic\'>$1</span>',
				'\[s\](.*?)\[/s\]' => '<span class=\'underline\'>$1</span>',
				'\[link url=([^\[\]]*)\](.*?)\[/link\]' => '<a href=\'$1\' target=\'blank\'>$2</a>',
				'\[img src=([^\[\]]*)\]' => '<img src=\'$1\' />'
			);
			foreach ($bbcode as $src => $dst) {
				$regex = '#' . $src . '#';
				$txt = preg_replace($regex, $dst, $txt);
			}
			return $txt;
		}
	}