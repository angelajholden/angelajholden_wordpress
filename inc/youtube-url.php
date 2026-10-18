<?php 
/*
* parse_youtube_url() PHP function
* @param string $url URL to be parsed, eg:
* http://youtu.be/BLxI_1iKYgc,
* http://www.youtube.com/embed/BLxI_1iKYgc
* http://www.youtube.com/watch?v=BLxI_1iKYgc
* @param string $return what to return
* - embed, return embed code
* - thumb, return URL to thumbnail image
* - hqthumb, return URL to high quality thumbnail image.
* @param string $width width of embeded video, default 560
* @param string $height height of embeded video, default 349
* @param string $rel whether embeded video to
   show related video after play or not.
* How to Use...
* // return thumb image
  echo parse_youtube_url('http://youtu.be/ML2KAaR26Pk','mqthumb');
* // return embed url
  echo parse_youtube_url('http://www.youtube.com/watch?v=ML2KAaR26Pk','embedurl');
*/

function parse_youtube_url($url, $return = 'embed', $width = '', $height = '', $rel = 0) {
  if (!is_string($url)) {
    return '';
  }
  $url = trim($url);
  $id = '';
  if (preg_match('/^[A-Za-z0-9_-]{11}$/D', $url)) {
    $id = $url;
  } else {
    $parts = parse_url($url);
    if (!is_array($parts) || !isset($parts['host']) ||
        (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), array('http', 'https'), true))) {
      return '';
    }
    $host = strtolower($parts['host']);
    $path = isset($parts['path']) ? $parts['path'] : '';
    if ($host === 'youtu.be') {
      $id = ltrim($path, '/');
    } elseif (in_array($host, array('youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtube-nocookie.com', 'www.youtube-nocookie.com'), true)) {
      if (preg_match('~^/(?:embed|shorts|live)/([A-Za-z0-9_-]{11})/?$~D', $path, $match)) {
        $id = $match[1];
      } elseif ($path === '/watch') {
        parse_str(isset($parts['query']) ? $parts['query'] : '', $query);
        $id = isset($query['v']) && is_string($query['v']) ? $query['v'] : '';
      }
    }
  }
  if (!preg_match('/^[A-Za-z0-9_-]{11}$/D', $id)) {
    return '';
  }
  if ($return === 'embed') {
    $width = is_scalar($width) && ctype_digit((string) $width) && (int) $width > 0 ? (int) $width : 560;
    $height = is_scalar($height) && ctype_digit((string) $height) && (int) $height > 0 ? (int) $height : 315;
    $src = 'https://www.youtube.com/embed/' . $id . '?rel=' . ($rel === 1 || $rel === '1' || $rel === true ? '1' : '0');
    return '<iframe width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" src="' . esc_url($src) . '" frameborder="0" allowfullscreen></iframe>';
  }
  if ($return === 'embedurl') {
    return 'https://www.youtube.com/embed/' . $id;
  }
  if ($return === 'thumb' || $return === 'mqthumb') {
    return 'https://i1.ytimg.com/vi/' . $id . '/' . ($return === 'thumb' ? 'default' : 'mqdefault') . '.jpg';
  }
  return $id;
}
