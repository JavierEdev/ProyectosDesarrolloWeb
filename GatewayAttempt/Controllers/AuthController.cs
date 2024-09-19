using Microsoft.AspNetCore.Mvc;
using System.Net;
using System.Net.Http;
using System.Threading.Tasks;

namespace gateway.Controllers
{
    [Route("api/auth")]
    [ApiController]
    public class AuthController : ControllerBase
    {
        private readonly HttpClient _httpClient;

        public AuthController(HttpClient httpClient)
        {
            _httpClient = httpClient;
        }

        [HttpPost("register")]
        public async Task<IActionResult> Register([FromBody] object userInfo)
        {
            var content = new StringContent(userInfo.ToString(), System.Text.Encoding.UTF8, "application/json");
            var response = await _httpClient.PostAsync("http://localhost/api/index.php/auth/register", content);
            var result = await response.Content.ReadAsStringAsync();
            return Content(result, response.Content.Headers.ContentType.ToString());
        }

        [HttpPost("login")]
        public async Task<IActionResult> Login([FromBody] object credentials)
        {
            var content = new StringContent(credentials.ToString(), System.Text.Encoding.UTF8, "application/json");
            var response = await _httpClient.PostAsync("http://localhost/api/index.php/auth/login", content);
            var result = await response.Content.ReadAsStringAsync();
            return Content(result, response.Content.Headers.ContentType.ToString());
        }
    }
}
