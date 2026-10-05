#!/usr/bin/env python3
"""
Build a single print-ready HTML document from the proposal Markdown files.

    python3 build-html.py

Reads:  Proposal-A-Technical-500.md
        Proposal-B-UIUX-Technical-1400.md
        site-audit-findings.md

Writes: Hardwick-and-Company-Proposals.html

Open the HTML in a browser and Print -> Save as PDF to attach to an email.
"""

import html
import re
from pathlib import Path

HERE = Path(__file__).parent

INLINE = [
    (re.compile(r"\*\*(.+?)\*\*"), r"<strong>\1</strong>"),
    (re.compile(r"(?<!\*)\*(?!\*)(.+?)(?<!\*)\*(?!\*)"), r"<em>\1</em>"),
    (re.compile(r"`(.+?)`"), r"<code>\1</code>"),
    (re.compile(r"\[(.+?)\]\((.+?)\)"), r'<a href="\2">\1</a>'),
]


def inline(text: str) -> str:
    """Escape then apply inline formatting."""
    text = html.escape(text, quote=False)
    for pattern, repl in INLINE:
        text = pattern.sub(repl, text)
    return text


def convert(md: str) -> str:
    """Convert the (deliberately simple) Markdown used in these proposals to HTML."""
    lines = md.split("\n")
    out: list[str] = []
    i = 0

    while i < len(lines):
        line = lines[i]
        stripped = line.strip()

        # Blank line
        if not stripped:
            i += 1
            continue

        # Fenced code block
        if stripped.startswith("```"):
            i += 1
            buf = []
            while i < len(lines) and not lines[i].strip().startswith("```"):
                buf.append(html.escape(lines[i]))
                i += 1
            i += 1
            out.append("<pre><code>" + "\n".join(buf) + "</code></pre>")
            continue

        # Horizontal rule
        if re.fullmatch(r"-{3,}", stripped):
            out.append("<hr>")
            i += 1
            continue

        # Table
        if stripped.startswith("|") and i + 1 < len(lines) and re.match(r"^\|[\s:|-]+\|$", lines[i + 1].strip()):
            header = [c.strip() for c in stripped.strip("|").split("|")]
            i += 2
            rows = []
            while i < len(lines) and lines[i].strip().startswith("|"):
                rows.append([c.strip() for c in lines[i].strip().strip("|").split("|")])
                i += 1
            out.append("<table><thead><tr>")
            out.append("".join(f"<th>{inline(c)}</th>" for c in header))
            out.append("</tr></thead><tbody>")
            for row in rows:
                out.append("<tr>" + "".join(f"<td>{inline(c)}</td>" for c in row) + "</tr>")
            out.append("</tbody></table>")
            continue

        # Blockquotes (consume the whole run so multi-line quotes stay in one box)
        if stripped.startswith(">"):
            buf = []
            while i < len(lines) and lines[i].strip().startswith(">"):
                buf.append(re.sub(r"^\s*>\s?", "", lines[i]))
                i += 1
            out.append("<blockquote>" + convert("\n".join(buf)) + "</blockquote>")
            continue

        # Heading
        m = re.match(r"^(#{1,6})\s+(.*)$", stripped)
        if m:
            level = len(m.group(1))
            out.append(f"<h{level}>{inline(m.group(2))}</h{level}>")
            i += 1
            continue

        # Unordered list
        if re.match(r"^[-*]\s+", stripped):
            items = []
            while i < len(lines) and re.match(r"^[-*]\s+", lines[i].strip()):
                items.append(inline(re.sub(r"^[-*]\s+", "", lines[i].strip())))
                i += 1
            out.append("<ul>" + "".join(f"<li>{t}</li>" for t in items) + "</ul>")
            continue

        # Ordered list
        if re.match(r"^\d+\.\s+", stripped):
            items = []
            while i < len(lines) and re.match(r"^\d+\.\s+", lines[i].strip()):
                items.append(inline(re.sub(r"^\d+\.\s+", "", lines[i].strip())))
                i += 1
            out.append("<ol>" + "".join(f"<li>{t}</li>" for t in items) + "</ol>")
            continue

        # Paragraph (consume until blank / next block starter)
        buf = []
        while i < len(lines):
            s = lines[i].strip()
            # NB: only break on a *genuine* block starter. A line beginning with
            # "*" is usually "**bold**" prose, not a list -- breaking on it would
            # leave `buf` empty and spin forever.
            if (
                not s
                or s.startswith(("#", ">", "|", "```"))
                or re.fullmatch(r"-{3,}", s)
                or re.match(r"^[-*]\s+", s)
                or re.match(r"^\d+\.\s+", s)
            ):
                break
            buf.append(s)
            i += 1
        if buf:
            out.append("<p>" + inline(" ".join(buf)) + "</p>")
        else:
            i += 1  # guarantee forward progress

    return "\n".join(out)


CSS = """
:root{
  --ink:#1a1a1a; --muted:#5c6470; --line:#e2e5ea; --accent:#7a1f2b;
  --accent-soft:#fbf3f4; --bg:#f6f7f9;
}
*{box-sizing:border-box}
body{
  margin:0; padding:0; background:var(--bg); color:var(--ink);
  font:16px/1.65 -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  -webkit-font-smoothing:antialiased;
}
.page{
  max-width:860px; margin:32px auto; background:#fff; padding:64px 72px;
  border-radius:10px; box-shadow:0 1px 3px rgba(0,0,0,.08),0 12px 40px rgba(0,0,0,.06);
}
h1,h2,h3,h4{line-height:1.25;margin:1.9em 0 .6em;font-weight:650;letter-spacing:-.01em}
h1{font-size:2.05em;margin-top:0}
h2{font-size:1.45em;padding-bottom:.35em;border-bottom:2px solid var(--line)}
h3{font-size:1.16em}
h4{font-size:1.02em;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;font-size:.85em}
p{margin:.85em 0}
ul,ol{margin:.85em 0;padding-left:1.4em}
li{margin:.34em 0}
a{color:var(--accent);text-decoration:none}
hr{border:0;border-top:1px solid var(--line);margin:2.6em 0}
strong{font-weight:650}
code{background:var(--bg);padding:.12em .38em;border-radius:4px;font-size:.9em;
  font-family:ui-monospace,SFMono-Regular,Menlo,monospace}
pre{background:#1f2328;color:#e6edf3;padding:18px 20px;border-radius:8px;overflow-x:auto}
pre code{background:none;color:inherit;padding:0}
blockquote{
  margin:1.5em 0;padding:20px 26px;background:var(--accent-soft);
  border-left:4px solid var(--accent);border-radius:0 8px 8px 0;
}
blockquote p:first-child{margin-top:0}
blockquote p:last-child{margin-bottom:0}
table{width:100%;border-collapse:collapse;margin:1.5em 0;font-size:.94em}
th,td{border:1px solid var(--line);padding:11px 14px;text-align:left;vertical-align:top}
th{background:#fafbfc;font-weight:650}
tbody tr:nth-child(even){background:#fcfcfd}
.doc-title{
  text-align:center;padding:100px 0 60px;border-bottom:3px double var(--line);margin-bottom:0;
}
.doc-title h1{border:0;padding:0;font-size:2.4em;margin-bottom:.2em}
.doc-title p{color:var(--muted);font-size:1.08em}
.doc-meta{margin-top:2em;color:var(--muted);font-size:.94em}
.section-break{page-break-before:always;border-top:3px double var(--line);padding-top:60px;margin-top:60px}
@media print{
  body{background:#fff}
  .page{box-shadow:none;margin:0;padding:0;max-width:none;border-radius:0}
  h2{page-break-after:avoid}
  table,blockquote,pre{page-break-inside:avoid}
  @page{margin:18mm}
}
@media(max-width:700px){
  .page{padding:32px 22px;margin:0;border-radius:0}
}
"""


def main() -> None:
    sources = [
        ("Proposal-A-Technical-500.md", "A"),
        ("Proposal-B-UIUX-Technical-1400.md", "B"),
        ("site-audit-findings.md", "Appendix"),
    ]

    body = []
    body.append(f"""
    <div class="doc-title">
      <h1>Hardwick &amp; Company</h1>
      <p>Website Proposals — hardwickandcompany.com</p>
      <p class="doc-meta">
        Prepared by [Your Name] &middot; [Date]<br>
        Proposal A — Technical Remediation: <strong>$500</strong><br>
        Proposal B — UI/UX Redesign + Technical: <strong>$1,400</strong>
      </p>
    </div>
    """)

    for filename, _label in sources:
        path = HERE / filename
        body.append('<div class="section-break">')
        body.append(convert(path.read_text(encoding="utf-8")))
        body.append("</div>")

    doc = f"""<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Hardwick &amp; Company — Website Proposals</title>
<style>{CSS}</style>
</head>
<body>
<div class="page">
{''.join(body)}
</div>
</body>
</html>
"""

    out = HERE / "Hardwick-and-Company-Proposals.html"
    out.write_text(doc, encoding="utf-8")
    print(f"Wrote {out} ({out.stat().st_size:,} bytes)")


if __name__ == "__main__":
    main()
