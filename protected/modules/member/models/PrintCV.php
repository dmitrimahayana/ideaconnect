<?php
class PrintCV extends CFormModel
{
	public $dataDiri;
	public $pendidikanFormal;
	public $pendidikanNonFormal;
	public $organisasi;
	public $pengalamanKerja;
	public $kelebihanDiri;
	public $rekomendasi;
	public $bahasaAsing;
	
	public function rules()
	{
		return array(
			array('dataDiri, pendidikanFormal, pendidikanNonFormal, organisasi, pengalamanKerja, kelebihanDiri, rekomendasi, bahasaAsing', 'numerical', 'integerOnly'=>true),
			array('dataDiri, pendidikanFormal, pendidikanNonFormal, organisasi, pengalamanKerja, kelebihanDiri, rekomendasi, bahasaAsing', 'safe'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'dataDiri' => 'Data Diri', 
			'pendidikanFormal' => 'Pendidikan Formal',
			'pendidikanNonFormal' => 'Pendidikan Non Formal',
			'organisasi' => 'Organisasi', 
			'pengalamanKerja' => 'Pengalaman Kerja', 
			'kelebihanDiri' => 'Kelebihan dan Kekurangan Diri',
			'rekomendasi' => 'Rekomendasi',
			'bahasaAsing' => 'Bahasa Asing',
		);
	}
}