import base64
import zlib
import urllib.request
import os

def render_diagram(diagram_path, output_png_path, diagram_type):
    if not os.path.exists(diagram_path):
        print(f"File not found: {diagram_path}")
        return

    with open(diagram_path, 'r', encoding='utf-8') as f:
        text = f.read()

    compressed = zlib.compress(text.encode('utf-8'), 9)
    payload = base64.urlsafe_b64encode(compressed).decode('utf-8')
    payload = payload.replace('=', '') # Strip padding if any
    
    url = f"https://kroki.io/{diagram_type}/png/{payload}"
    print(f"Requesting {output_png_path}...")
    try:
        req = urllib.request.Request(
            url, 
            data=None, 
            headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}
        )
        with urllib.request.urlopen(req) as response:
            with open(output_png_path, 'wb') as out_file:
                out_file.write(response.read())
        print(f"Saved {output_png_path} successfully.")
    except Exception as e:
        print(f"Failed to generate {output_png_path}: {e}")

if __name__ == '__main__':
    tree_target = r"c:\xampp\htdocs\planova\college-event-management\FSD_Report__1___1_\tree.puml"
    tree_out = r"c:\xampp\htdocs\planova\college-event-management\FSD_Report__1___1_\deployment_tree.png"
    render_diagram(tree_target, tree_out, 'plantuml')
