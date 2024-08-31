<?php declare(strict_types=1);

class MyFileWriter{
  private string $fileName;
  protected string $fullText = '';
  public const APPEND = FILE_APPEND;

  function __construct(string $fileName){
    $this->fileName = $fileName;
  }

  function append(string $content):self{
    $this->fullText .= $content;
    return $this;
  }

  function newline():self{
    $this->fullText .= PHP_EOL;
    return $this;
  }

  function commit(int $flag=0):self{
    file_put_contents($this->fileName, $this->fullText, $flag);
    echo $this->fullText;
    $this->fullText = '';
    return $this;
  }
}

class LogWriter extends MyFileWriter {
  function append(string $content):self{
    $timeStr = date('Y/m/d H:i:s');
    $this->fullText .= sprintf('%s %s', $timeStr, $content);
    return $this;
  }
}

$file = new MyFileWriter("sample.txt");
$file->append('Hello, Bob.')
    ->newline()
    ->append('Bye, ')
    ->append('Bob.')
    ->newline()
    ->commit()
    ->append('Good night, Bob.')
    ->commit(MyFileWriter::APPEND);

$info = new LogWriter('info.log');
$error = new LogWriter('error.log');

$info->append('これは通常ログです。')
    ->newline()
    ->commit(LogWriter::APPEND);

$error->append('これはエラーログです。')
    ->newline()
    ->commit(LogWriter::APPEND);
    