<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
class Pdf extends DOMPDF
{
	/**
	 * Get an instance of CodeIgniter
	 *
	 * @access  protected
	 * @return  void
	 */
	protected function ci()
	{
		return get_instance();
	}

	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access  public
	 * @param   string  $view The view to load
	 * @param   array   $data The view data
	 * @return  void
	 */
	public function load_view($view, $data = array())
	{
		$dompdf = new Dompdf();
		$options = new \Dompdf\Options();
		$html = $this->ci()->load->view($view, $data, TRUE);

		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$options->set('isPhpEnabled', true);
		$options->set('enable-javascript', true);
		$options->set('images', true);
		$options->set('javascript-delay', 13000); // page load is quick but even a high number doesn't help
		$options->set('enable-smart-shrinking', true);
		$options->set('no-stop-slow-scripts', true);
		//$dompdf->set('enable-javascript', true);
		$dompdf->setOptions($options);
		// Render the HTML as PDF
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$time = time();

		// Output the generated PDF to Browser
		$dompdf->stream("SWCMS_Report-". $time);
	}
}

?>
