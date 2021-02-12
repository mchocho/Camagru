function xhr(url, send=null, method="POST")
{
  return new Promise((resolve, reject) =>
  {
    const xhr = new XMLHttpRequest();

    xhr.onload = function()
    {
      if (xhr.status != 200)
        reject(xhr);
      else
        resolve(xhr);
    };

    xhr.open(method, url);
  	xhr.send(send);
  });
}