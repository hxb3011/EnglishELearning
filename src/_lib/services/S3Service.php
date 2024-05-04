<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("vendor/aws/aws-autoloader.php");

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
class S3Service
{
    private $s3Config = [
        'version' => 'latest',
        'region' => 'ap-southeast-1',
        'access_key' => 'AKIA6GBMBODTERALG3F5',
        'secret_key' => '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',
        'bucket' => 'english-elearning',
        'basePath'=>'https://english-elearning.s3.ap-southeast-1.amazonaws.com/'
    ];
    private function createClient()
    {
        $s3 = new S3Client([
            'version' => $this->s3Config['version'],
            'region'  => $this->s3Config['region'],
            'credentials' => [
                'key'    => $this->s3Config['access_key'],
                'secret' => $this->s3Config['secret_key'],
            ]
        ]);
        return $s3;
    }
    public function uploadFileToBucket($fileSource, $file_name, $isPublic = true)
    {
        $s3 = $this->createClient();
        $response = [
            'error'=>null,
        ];
        try {
            if ($isPublic)
            {
                $result = $s3->putObject([
                    'Bucket' => $this->s3Config['bucket'],
                    'Key'    => $file_name,
                    'SourceFile' => $fileSource,
                    'ACL'        => 'public-read',
                ]);
            }else{
                $result = $s3->putObject([
                    'Bucket' => $this->s3Config['bucket'],
                    'Key'    => $file_name,
                    'SourceFile' => $fileSource,
                ]);
            }
            $result_arr = $result->toArray();

            if (!empty($result_arr['ObjectURL'])) {
                $s3_file_link = $result_arr['ObjectURL'];
                $response['ObjectURL'] = $s3_file_link;
            } else {
                $response['error'] = 'Tải lên thấy bại';
            }
        } catch (S3Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
    public function deleteFileInBucket($filePath)
    {
        $s3 = $this->createClient();
        try {
            $result = $s3->deleteObject(
                [
                    'Bucket' => $this->s3Config['bucket'],
                    'Key'=> $filePath
                ]);
            $result_arr = $result->toArray();
            return $result_arr; 
            
        } catch (S3Exception $e) {
            return [$e->getMessage()];
        }
    }
    public function deleteFileInFolder($folderPath)
    {
        $s3 = $this->createClient();
        try {
            $files = $s3->listObjectsV2([
                'Bucket' =>$this->s3Config['bucket'] ,
                'Prefix' => $folderPath
            ]);
            if (isset($files['Contents'])) {
                foreach ($files['Contents'] as $file) {
                    $s3->deleteObject([
                        'Bucket' => $this->s3Config['bucket'],
                        'Key' => $file['Key']
                    ]);
                }
            }
            
        } catch (S3Exception $e) {
            return [$e->getMessage()];
        }
    }
    public function getBasePath()
    {
        return $this->s3Config['basePath'];
    }
    public function encodeKey($key)
    {
        $s3 = $this->createClient();
        return $s3->encodeKey($key);
    }
}
