<?php

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;

class AWSController extends Controller
{

  protected $options = [
    'region' => 'ap-southeast-1',
    'version' => 'latest',
  ];

  public function submit_face_detector(Request $request)
  {
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);
    $client = new RekognitionClient($this->options);
    $image = $request->file('image');
    $result = $client->detectFaces([
      'Attributes' => ['ALL'],
      'Image' => [
        'Bytes' => file_get_contents($image->getRealPath()),
      ],
    ]);

    return $result->get('FaceDetails');
  }

  public function submit_celebrity_recognition(Request $request)
  {
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);
    $client = new RekognitionClient($this->options);
    $image = $request->file('image');
    $result = $client->recognizeCelebrities([
      'Image' => [
        'Bytes' => file_get_contents($image->getRealPath()),
      ],
    ]);

    return $result->get('CelebrityFaces');
  }

  public function submit_text_recognition(Request $request)
  {
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);
    $client = new RekognitionClient($this->options);
    $image = $request->file('image');
    $result = $client->detectText([
      'Image' => [
        'Bytes' => file_get_contents($image->getRealPath()),
      ],
    ]);

    return $result->get('TextDetections');
  }

  public function submit_face_compare(Request $request)
  {
    $request->validate([
      'image_source' => 'required|image|mimes:jpeg,png,jpg|max:5120',
      'image_target' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);
    $client = new RekognitionClient($this->options);
    $result = $client->compareFaces([
      'SimilarityThreshold' => 85,
      'SourceImage' => [
        'Bytes' => file_get_contents($request->file('image_source')->getRealPath()),
      ],
      'TargetImage' => [
        'Bytes' => file_get_contents($request->file('image_target')->getRealPath()),
      ],
    ]);

    return $result->get('FaceMatches');
  }

  public function submit_object_detection(Request $request)
  {
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);
    $client = new RekognitionClient($this->options);
    $image = $request->file('image');
    $result = $client->detectLabels([
      'Image' => [
        'Bytes' => file_get_contents($image->getRealPath()),
      ],
      'MinConfidence' => 80,
    ]);

    return $result->get('Labels');
  }
}
